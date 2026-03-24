<?php

namespace Modules\BookingModule\Entities;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Mail;
use Modules\BookingModule\Http\Traits\BookingScopes;
use Modules\BookingModule\Http\Traits\BookingTrait;
use Modules\BusinessSettingsModule\Emails\CashInHandOverflowMail;
use Modules\BusinessSettingsModule\Entities\PackageSubscriber;
use Modules\ProviderManagement\Entities\Provider;
use Modules\UserManagement\Entities\Serviceman;

class BookingRepeat extends Model
{
    use HasFactory, HasUuid, BookingTrait, BookingScopes;

    protected $casts = [
        'is_paid' => 'integer',
        'is_verified' => 'integer',
        'total_booking_amount' => 'float',
        'total_tax_amount' => 'float',
        'total_discount_amount' => 'float',
        'total_campaign_discount_amount' => 'float',
        'total_coupon_discount_amount' => 'float',
        'is_checked' => 'integer',
        'additional_charge' => 'float',
        'additional_tax_amount' => 'float',
        'additional_discount_amount' => 'float',
        'additional_campaign_discount_amount' => 'float',
        'evidence_photos' => 'array',
        'extra_fee' => 'float',
        'total_referral_discount_amount' => 'float',
    ];

    protected $fillable = [
        'id',
        'readable_id',
        'provider_id',
        'booking_status',
        'is_paid',
        'payment_method',
        'transaction_id',
        'total_booking_amount',
        'total_tax_amount',
        'total_discount_amount',
        'service_schedule',
        'service_address_id',
        'created_at',
        'updated_at',
        'category_id',
        'sub_category_id',
        'serviceman_id',
        'total_campaign_discount_amount',
        'total_coupon_discount_amount',
        'coupon_code',
        'is_checked',
        'additional_charge',
        'additional_tax_amount',
        'additional_discount_amount',
        'additional_campaign_discount_amount',
        'evidence_photos',
        'booking_otp',
        'is_verified',
        'service_address_location',
        'service_location',
    ];

    protected $appends = ['evidence_photos_full_path', 'skipNotification'];

    protected $hidden = ['skipNotification'];

    public function getSkipNotificationAttribute()
    {
        return $this->attributes['skipNotification'] ?? false;
    }

    public function setSkipNotificationAttribute($value)
    {
        $this->attributes['skipNotification'] = $value;
    }

    protected static function newFactory()
    {
        return \Modules\BookingModule\Database\factories\BookingRepeatFactory::new();
    }
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function serviceman(): BelongsTo
    {
        return $this->belongsTo(Serviceman::class, 'serviceman_id');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(BookingRepeatDetails::class);
    }

    public function details_amounts(): hasMany
    {
        return $this->hasMany(BookingDetailsAmount::class);
    }

    public function booking_details_amounts(): hasOne
    {
        return $this->hasOne(BookingDetailsAmount::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(BookingStatusHistory::class, 'booking_repeat_id');
    }

    public function scheduleHistories(): HasMany
    {
        return $this->hasMany(BookingScheduleHistory::class, 'booking_repeat_id');
    }

    public function repeatHistories(): HasMany
    {
        return $this->hasMany(BookingRepeatHistory::class, 'booking_repeat_id')->latest();
    }

    public function getEvidencePhotosFullPathAttribute()
    {
        $evidenceImages = $this->evidence_photos ?? [];
        $defaultImagePath = asset('public/assets/admin-module/img/media/user.png');
        if (empty($evidenceImages)) {
            if (request()->is('api/*')) {
                $defaultImagePath = null;
            }
            return $defaultImagePath ? [$defaultImagePath] : [];
        }

        $path = 'booking/evidence/';

        return getIdentityImageFullPath(identityImages: $evidenceImages, path: $path, defaultPath: $defaultImagePath);
    }

    public static function boot()
    {
        parent::boot();

        self::updating(function ($model) {
            $booking_notification_status = business_config('booking', 'notification_settings')->live_values;
            $permission = isNotificationActive(null, 'booking', 'notification', 'user');
            $providerPermission = isNotificationActive(null, 'booking', 'notification', 'provider');
            $servicemanPermission = isNotificationActive(null, 'booking', 'notification', 'serviceman');

            if ($model->isDirty('booking_status')) {
                $key = null;
                if ($model->booking_status == 'ongoing') {
                    if ($permission) {
                        $notifications[] = [
                            'key' => 'booking_ongoing',
                            'settings_type' => 'customer_notification'
                        ];
                    }
                    if ($providerPermission){
                        $notifications[] = [
                            'key' => 'ongoing_booking',
                            'settings_type' => 'provider_notification'
                        ];
                    }
                    if ($servicemanPermission) {
                        $notifications[] = [
                            'key' => 'ongoing_booking',
                            'settings_type' => 'serviceman_notification'
                        ];
                    }
                } elseif ($model->booking_status == 'completed') {
                    if ($permission) {
                        $notifications[] = [
                            'key' => 'booking_complete',
                            'settings_type' => 'customer_notification'
                        ];
                    }
                    if ($providerPermission) {
                        $notifications[] = [
                            'key' => 'booking_complete',
                            'settings_type' => 'provider_notification'
                        ];
                    }
                    if ($servicemanPermission) {
                        $notifications[] = [
                            'key' => 'booking_complete',
                            'settings_type' => 'serviceman_notification'
                        ];
                    }

                    $model->is_paid = 1;

                    $provider = $model->provider;

                    if ($provider) {
                        $model->update_admin_commission($model, $model->total_booking_amount, $model->provider_id);
                    }


                    if (!$model?->booking?->is_guest && $model?->booking?->customer) {
                        $model->referral_earning_calculation($model?->booking?->customer_id, $model?->booking?->zone_id);

                        $model->loyaltyPointCalculation($model?->booking?->customer_id, $model->total_booking_amount);

                        if ($model->total_referral_discount_amount > 0){
                            referralEarningTransactionAfterBookingRepeatCompleteFirst($model->customer, $model->total_referral_discount_amount, $model->id);
                        }
                    }

                    //================ Transactions for Booking ================

                    if ($model?->provider) {
                        if ($model->payment_method == 'cash_after_service') {
                            completeBookingRepeatTransactionForCashAfterService($model);
                        } else {
                            if ($model->additional_charge == 0) {
                                completeBookingRepeatTransactionForDigitalPayment($model);
                            }

//                            if ($model->additional_charge > 0) {
//                                completeBookingTransactionForDigitalPaymentAndExtraService($model);
//                            }
                        }

                        $limit_status = provider_warning_amount_calculate($provider->owner->account->account_payable, $provider->owner->account->account_receivable);

                        if ($limit_status == '100_percent' && business_config('suspend_on_exceed_cash_limit_provider', 'provider_config')->live_values) {
                            $provider->is_suspended = 1;
                            $provider->save();

                            $notification = isNotificationActive($provider?->id, 'transaction', 'notification', 'provider');
                            $title = get_push_notification_message('provider_suspend', 'provider_notification', $provider?->owner?->current_language_key);
                            if ($provider?->owner?->fcm_token && $title && $notification) {
                                device_notification($provider?->owner?->fcm_token, $title, null, null, $model->id, 'suspend', null, $provider->id);
                            }

                            $emailStatus = business_config('email_config_status', 'email_config')->live_values;

                            if ($emailStatus){
                                try {
                                    Mail::to($provider?->owner?->email)->send(new CashInHandOverflowMail($provider));
                                } catch (\Exception $exception) {
                                    info($exception);
                                }
                            }

                        }
                    }

                } elseif ($model->booking_status == 'canceled' && $model->skipNotification) {
                    if ($permission) {
                        $notifications[] = [
                            'key' => 'booking_cancel',
                            'settings_type' => 'customer_notification'
                        ];
                    }
                    if ($providerPermission) {
                        $notifications[] = [
                            'key' => 'booking_cancel',
                            'settings_type' => 'provider_notification'
                        ];
                    }
                    if ($servicemanPermission) {
                        $notifications[] = [
                            'key' => 'booking_cancel',
                            'settings_type' => 'serviceman_notification'
                        ];
                    }

//                    if ($model?->customer) {
//                        refundTransactionForCanceledBooking($model);
//                    }

                }
//                elseif ($model->booking_status == 'refund_request') {
//                    if ($permission) {
//                        $notifications[] = [
//                            [
//                                'key' => 'refund',
//                                'settings_type' => 'customer_notification'
//                            ]
//                        ];
//                    }
//                }


                if (isset($booking_notification_status) && $booking_notification_status['push_notification_booking']) {
                    foreach ($notifications ?? [] as $notification) {
                        $key = $notification['key'];
                        $settingsType = $notification['settings_type'];

                        if ($settingsType == 'customer_notification') {
                            $user = $model?->booking?->customer;
                            $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                            $title = get_push_notification_message($key, $settingsType, $user?->current_language_key);
                            $permission = isNotificationActive(null, 'booking', 'notification', 'user');
                            if ($user?->fcm_token && $user?->is_active && $title && $permission) {
                                device_notification($user?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                            }
                        }

                        if ($settingsType == 'provider_notification') {

                            if ((!business_config('suspend_on_exceed_cash_limit_provider', 'provider_config')->live_values || $model?->provider?->is_suspended == 0) && $model->booking_status == 'pending') {
                                $provider = $model?->provider?->owner;
                                $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                                $title = get_push_notification_message($key, $settingsType, $provider?->current_language_key);

                                if ($provider?->fcm_token && $title && sendDeviceNotificationPermission($model?->provider_id)) {
                                    device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                                }
                            } else {
                                $provider = $model?->provider?->owner;
                                $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                                $title = get_push_notification_message($key, $settingsType, $provider?->current_language_key);

                                if ($provider?->fcm_token && $title  && sendDeviceNotificationPermission($model?->provider_id)) {
                                    device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                                }
                            }
                        }

                        if ($settingsType == 'serviceman_notification') {
                            $serviceman = $model?->serviceman?->user;
                            $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                            $title = get_push_notification_message($key, $settingsType, $serviceman?->current_language_key);
                            if ($serviceman?->fcm_token && $title) {
                                device_notification($serviceman?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                            }
                        }
                    }
                }
            }
        });

        self::updated(function ($model) {
            $status = $model->booking_status;
            $bookingScheduleTimeChange = isNotificationActive(null, 'booking', 'notification', 'user');
            $bookingScheduleTimeChangeProvider = isNotificationActive(null, 'booking', 'notification', 'provider');
            $bookingScheduleTimeChangeServiceman = isNotificationActive(null, 'booking', 'notification', 'serviceman');

            $notifications = [];
            $booking_notification_status = business_config('booking', 'notification_settings')->live_values;

            if ($model->isDirty('serviceman_id')) {
                if ($bookingScheduleTimeChange) {
                    $notifications[] = [
                        'key' => 'serviceman_assign',
                        'settings_type' => 'customer_notification'
                    ];
                }
                if ($bookingScheduleTimeChangeProvider) {
                    $notifications[] = [
                        'key' => 'serviceman_assign',
                        'settings_type' => 'provider_notification'
                    ];
                }
                if ($bookingScheduleTimeChangeServiceman) {
                    $notifications[] = [
                        'key' => 'serviceman_assign',
                        'settings_type' => 'serviceman_notification'
                    ];
                }
            }

            if ($model->isDirty('service_schedule')) {
                if ($bookingScheduleTimeChange) {
                    $notifications[] = [
                        'key' => 'booking_schedule_time_change',
                        'settings_type' => 'customer_notification'
                    ];
                }
                if ($bookingScheduleTimeChangeProvider) {
                    $notifications[] = [
                        'key' => 'booking_schedule_time_change',
                        'settings_type' => 'provider_notification'
                    ];
                }
                if ($bookingScheduleTimeChangeServiceman) {
                    $notifications[] = [
                        'key' => 'booking_schedule_time_change',
                        'settings_type' => 'serviceman_notification'
                    ];
                }
            }

            if (isset($booking_notification_status) && $booking_notification_status['push_notification_booking']) {
                foreach ($notifications ?? [] as $notification) {
                    $key = $notification['key'];
                    $settingsType = $notification['settings_type'];

                    if ($settingsType == 'customer_notification') {
                        $user = $model?->booking?->customer;
                        $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                        $title = get_push_notification_message($key, $settingsType, $user?->current_language_key);
                        if ($user?->fcm_token && $title) {
                            device_notification($user?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                        }
                    }

                    if ($settingsType == 'provider_notification') {
                        if ((!business_config('suspend_on_exceed_cash_limit_provider', 'provider_config')->live_values || $model?->provider?->is_suspended == 0) && $model->booking_status == 'pending') {
                            $provider = $model?->provider?->owner;
                            $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                            $title = get_push_notification_message($key, $settingsType, $provider?->current_language_key);
                            if ($provider?->fcm_token && $title && sendDeviceNotificationPermission($model?->provider_id)) {
                                device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                            }
                        } else {
                            $provider = $model?->provider?->owner;
                            $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                            $title = get_push_notification_message($key, $settingsType, $provider?->current_language_key);
                            if ($provider?->fcm_token && $title && sendDeviceNotificationPermission($model?->provider_id)) {
                                device_notification($provider?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                            }
                        }
                    }

                    if ($settingsType == 'serviceman_notification') {
                        $serviceman = $model?->serviceman?->user;
                        $repeatOrRegular = $model?->booking?->is_repeated ? 'repeat' : 'regular';
                        $title = get_push_notification_message($key, $settingsType, $serviceman?->current_language_key);
                        if ($serviceman?->fcm_token && $title) {
                            device_notification($serviceman?->fcm_token, $title, null, null, $model->id, 'booking', null, null, null, null, $repeatOrRegular, 'single');
                        }
                    }
                }
            }
        });


        self::deleting(function ($model) {

        });

        self::deleted(function ($model) {

        });
    }
}
