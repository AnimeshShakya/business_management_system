<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Traits\FirebaseAuthTrait;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\SMSModule\Lib\SMS_gateway;
use Modules\UserManagement\Emails\OTPMail;
use Modules\UserManagement\Entities\User;
use Modules\UserManagement\Entities\UserVerification;
use Modules\PaymentModule\Traits\SmsGateway;

class VerificationController extends Controller
{
    use FirebaseAuthTrait;
    public function __construct(
        private User             $user,
        private UserVerification $user_verification
    )
    {
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('auth::verification.send-otp');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return RedirectResponse|Renderable
     * @throws ValidationException
     */
    public function sendOtp(Request $request): RedirectResponse|Renderable
    {
        Validator::make($request->all(), [
            'identity' => 'required|max:255',
            'identity_type' => 'required|in:phone,email'
        ])->validate();

        $user = $this->user->where($request['identity_type'], $request['identity'])->whereIn('user_type', PROVIDER_USER_TYPES)->first();
        if (!isset($user)) {
            Toastr::error(translate(DEFAULT_404['message']));
            return view('auth::verification.send-otp', compact('user'));
        }

        $user_verification = $this->user_verification->where('identity', $request['identity'])->first();
        $otp_resend_time = business_config('otp_resend_time', 'otp_login_setup')?->live_values;


        if (isset($user_verification) && Carbon::parse($user_verification->updated_at)->DiffInSeconds() < $otp_resend_time) {
            $time = $otp_resend_time - Carbon::parse($user_verification->updated_at)->DiffInSeconds();
            Toastr::error(translate('Please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());
            return view('auth::verification.send-otp', compact('user'));
        }

        $otp = env('APP_ENV') != 'live' ? '123456' : rand(100000, 999999);

        $response = 'error';
        if ($request['identity_type'] == 'phone') {
            $phonePermission = isNotificationActive(null, 'verification', 'sms', 'provider');
            if ($phonePermission) {

                $firebaseOtpConfig = business_config('firebase_otp_verification', 'third_party');
                $firebaseOtpStatus = (int)$firebaseOtpConfig?->live_values['status'] ?? null;

                if ($firebaseOtpConfig && $firebaseOtpStatus){
                    $firebaseResponse = $this->sendFirebaseOtp($request['identity']);
                    $response = $firebaseResponse['status'];
                    $otp = $firebaseResponse['sessionInfo'];
                }else{
                    $published_status = 0;
                    $payment_published_status = config('get_payment_publish_status');
                    if (isset($payment_published_status[0]['is_published'])) {
                        $published_status = $payment_published_status[0]['is_published'];
                    }

                    if ($published_status == 1) {
                        $response = SmsGateway::send($request['identity'], $otp);
                    } else {
                        $response = SMS_gateway::send($request['identity'], $otp);
                    }
                }
            }

        } else if ($request['identity_type'] == 'email') {
            $emailPermission = isNotificationActive(null, 'verification', 'email', 'provider');
            if ($emailPermission) {
                try {
                     $emailStatus = business_config('email_config_status', 'email_config')->live_values;
                     if ($emailStatus){
                         Mail::to($request['identity'])->send(new OTPMail($otp));
                         $response = 'success';
                     }else{
                         $response = 'error';
                     }
                } catch (\Exception $exception) {
                    $response = 'error';
                }
            }
        } else {
            $response = 'error';
        }

        if ($response == 'success') {
            $this->user_verification->updateOrCreate([
                'identity' => $request['identity'],
                'identity_type' => $request['identity_type']
            ], [
                'identity' => $request['identity'],
                'identity_type' => $request['identity_type'],
                'user_id' => null,
                'otp' => $otp,
                'expires_at' => now()->addMinute(3),
            ]);

            Session::put('identity', $request['identity']);
            Session::put('identity_type', $request['identity_type']);

            Toastr::success(translate(DEFAULT_SENT_OTP_200['message']));
            return view('auth::verification.verify-otp');

        } else {
            Toastr::error(translate(DEFAULT_SENT_OTP_FAILED_200['message']));
            return view('auth::verification.send-otp', compact('user'));
        }
    }


    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity' => 'required',
            'identity_type' => 'required',
            'otp' => 'required|max:6'
        ]);

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first());
            return redirect()->back();
        }

        $config = [
            'max_otp_hit' => business_config('maximum_otp_hit', 'otp_login_setup')->test_values ?? 5,
            'max_otp_hit_time' => business_config('otp_resend_time', 'otp_login_setup')->test_values ?? 60, // seconds
            'temp_block_time' => business_config('temporary_otp_block_time', 'otp_login_setup')->test_values ?? 600, // seconds
            'firebase_status' => (int) (business_config('firebase_otp_verification', 'third_party')?->live_values['status'] ?? 0)
        ];

        $verification_data = $this->user_verification->where('identity', $request['identity'])->first();
        $user = $this->user->where('phone', $request['identity'])->orWhere('email', $request['identity'])->first();

        if (!$verification_data) {
            return $this->checkOTPValidation($request, $user, $config);
        }

        // Check if temporarily blocked
        if ($verification_data->temp_block_time && Carbon::parse($verification_data->temp_block_time)->DiffInSeconds() <= $config['temp_block_time']) {
            $time_left = $config['temp_block_time'] - Carbon::parse($verification_data->temp_block_time)->DiffInSeconds();
            Toastr::error(translate('please_try_again_after_') . CarbonInterval::seconds($time_left)->cascade()->forHumans());
            return view('auth::verification.send-otp', compact('user'));
        }

        // Firebase OTP verification
        if ($config['firebase_status'] && $request['identity_type'] == 'phone') {
            $firebaseResponse = $this->verifyFirebaseOtp($verification_data['otp'], $request['identity'], $request['otp']);
            if ($firebaseResponse['status'] === 'success') {
                $user->update(['is_phone_verified' => 1]);
                $verification_data->delete();
                Toastr::success(translate(OTP_VERIFICATION_SUCCESS_200['message']));
                return redirect(route('provider.auth.login'));
            }
            return $this->checkOTPValidation($request, $user, $config);
        }

        // Regular OTP verification
        if ($request['identity_type'] == 'email') {
            $user->update(['is_email_verified' => 1]);
        } elseif ($request['identity_type'] == 'phone') {
            $user->update(['is_phone_verified' => 1]);
        }

        $verification_data->where(['identity' => $request['identity'], 'otp' => $request['otp']])->delete();

        Toastr::success(translate(OTP_VERIFICATION_SUCCESS_200['message']));
        return redirect(route('provider.auth.login'));
    }

    private function checkOTPValidation($request, $user, $config)
    {
        $verification_data = $this->user_verification->where('identity', $request['identity'])->first();

        if (!$verification_data) {
            $message = translate(DEFAULT_400['message']);
            Toastr::error($message);
            return redirect()->back();
        }

        // Handle temporary block
        if ($verification_data->temp_block_time && Carbon::parse($verification_data->temp_block_time)->DiffInSeconds() <= $config['temp_block_time']) {
            $time_left = $config['temp_block_time'] - Carbon::parse($verification_data->temp_block_time)->DiffInSeconds();
            Toastr::error(translate('please_try_again_after_') . CarbonInterval::seconds($time_left)->cascade()->forHumans());
            return view('auth::verification.send-otp', compact('user'));
        }

        // Reset block if timeout has passed
        if ($verification_data->is_temp_blocked && Carbon::parse($verification_data->updated_at)->DiffInSeconds() >= $config['max_otp_hit_time']) {
            $verification_data->update(['hit_count' => 0, 'is_temp_blocked' => 0, 'temp_block_time' => null]);
        }

        // Check if max OTP attempts exceeded
        if ($verification_data->hit_count >= $config['max_otp_hit'] &&
            Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $config['max_otp_hit_time'] &&
            !$verification_data->is_temp_blocked) {

            $verification_data->update(['is_temp_blocked' => 1, 'temp_block_time' => now()]);

            $time_left = $config['temp_block_time'] - Carbon::parse($verification_data->temp_block_time)->DiffInSeconds();
            Toastr::error(translate('Too_many_attempts. please_try_again_after_') . CarbonInterval::seconds($time_left)->cascade()->forHumans());
            return view('auth::verification.send-otp', compact('user'));
        }

        // Increment OTP attempt count
        $verification_data->increment('hit_count');
    }













//    public function verifyOtp(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'identity' => 'required',
//            'identity_type' => 'required',
//            'otp' => 'required|max:6'
//        ]);
//
//        if ($validator->fails()) {
//            $error = error_processor($validator);
//            $message = $error[0]['message'] ?? translate(DEFAULT_400['message']);
//            Toastr::error($message);
//            return redirect()->back();
//        }
//
//        $max_otp_hit = business_config('maximum_otp_hit', 'otp_login_setup')->test_values ?? 5;
//        $max_otp_hit_time = business_config('otp_resend_time', 'otp_login_setup')->test_values ?? 60;// seconds
//        $temp_block_time = business_config('temporary_otp_block_time', 'otp_login_setup')->test_values ?? 600; // seconds
//
//        $verify = $this->user_verification->where(['identity' => $request['identity']])->first();
//        $user = $this->user->orWhere('phone', $request['identity'])->orWhere('email', $request['identity'])->first();
//
//        if (isset($verify)) {
//            if (isset($verify->temp_block_time) && Carbon::parse($verify->temp_block_time)->DiffInSeconds() <= $temp_block_time) {
//                $time = $temp_block_time - Carbon::parse($verify->temp_block_time)->DiffInSeconds();
//                Toastr::success(translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());
//                return view('auth::verification.send-otp', compact('user'));
//            }
//
//            $firebaseOtpConfig = business_config('firebase_otp_verification', 'third_party');
//            $firebaseOtpStatus = (int)$firebaseOtpConfig?->live_values['status'] ?? null;
//
//            if ($firebaseOtpStatus && $request['identity_type'] == 'phone'){
//                $firebaseResponse = $this->verifyFirebaseOtp(sessionInfo: $verify['otp'], phoneNumber: $request['identity'], otp: $request['otp']);
//                $firebaseResponseStatus = $firebaseResponse['status'];
//                if ($firebaseResponseStatus == 'success'){
//                    $user->is_phone_verified = 1;
//                    $user->save();
//
//                    $this->user_verification->where(['identity' => $request['identity']])->delete();
//                }else{
//                    $this->checkOTPValidation(request: $request, user: $user, temp_block_time: $temp_block_time, max_otp_hit_time: $max_otp_hit_time, max_otp_hit: $max_otp_hit);
//                }
//
//            }else{
//                if ($request['identity_type'] == 'email') {
//                    $user = $this->user->where('email', $request['identity'])->first();
//                    $user->is_email_verified = 1;
//                    $user->save();
//
//                } else if ($request['identity_type'] == 'phone') {
//                    $user = $this->user->where('phone', $request['identity'])->first();
//                    $user->is_phone_verified = 1;
//                    $user->save();
//                }
//                $this->user_verification->where(['identity' => $request['identity'], 'otp' => $request['otp']])->delete();
//            }
//
//            Toastr::success(translate(OTP_VERIFICATION_SUCCESS_200['message']));
//            return redirect(route('provider.auth.login'));
//
//        } else {
//            $this->checkOTPValidation(request: $request, user: $user, temp_block_time: $temp_block_time, max_otp_hit_time: $max_otp_hit_time, max_otp_hit: $max_otp_hit);
//        }
//
//        Toastr::error(translate(OTP_VERIFICATION_FAIL_403['message']));
//        return view('auth::verification.send-otp', compact('user'));
//    }
//
//    private function checkOTPValidation($request, $user, $temp_block_time, $max_otp_hit_time, $max_otp_hit)
//    {
//
//        $verification_data = $this->user_verification->where('identity', $request['identity'])->first();
//
//        if (isset($verification_data)) {
//            if (isset($verification_data->temp_block_time) && Carbon::parse($verification_data->temp_block_time)->DiffInSeconds() <= $temp_block_time) {
//                $time = $temp_block_time - Carbon::parse($verification_data->temp_block_time)->DiffInSeconds();
//                Toastr::error(translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());
//                return view('auth::verification.send-otp', compact('user'));
//            }
//
//            if ($verification_data->is_temp_blocked == 1 && Carbon::parse($verification_data->updated_at)->DiffInSeconds() >= $max_otp_hit_time) {
//
//                $user_verify = $this->user_verification->where(['identity' => $request['identity']])->first();
//                if (!isset($user_verify)) {
//                    $user_verify = $this->user_verification;
//                }
//                $user_verify->hit_count = 0;
//                $user_verify->is_temp_blocked = 0;
//                $user_verify->temp_block_time = null;
//                $user_verify->save();
//            }
//
//            if ($verification_data->hit_count >= $max_otp_hit && Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $max_otp_hit_time && $verification_data->is_temp_blocked == 0) {
//
//                $user_verify = $this->user_verification->where(['identity' => $request['identity']])->first();
//                if (!isset($user_verify)) {
//                    $user_verify = $this->user_verification;
//                }
//                $user_verify->is_temp_blocked = 1;
//                $user_verify->temp_block_time = now();
//                $user_verify->save();
//
//                $time = $temp_block_time - Carbon::parse($verification_data->temp_block_time)->DiffInSeconds();
//                Toastr::error(translate('Too_many_attempts. please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());
//                return view('auth::verification.send-otp', compact('user'));
//            }
//        }
//
//        $user_verify = $this->user_verification->where(['identity' => $request['identity']])->first();
//        if (!isset($user_verify)) {
//            $user_verify = $this->user_verification;
//        }
//        $user_verify->hit_count += 1;
//        $user_verify->temp_block_time = null;
//        $user_verify->save();
//    }
}
