<?php

namespace Modules\BusinessSettingsModule\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class ThirdPartyDataStoreOrUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'party_name' => 'required|string|in:google_map,firebase,push_notification,firebase_otp_verification,recaptcha,apple_login,email_config,sms_config,payment_config,storage_connection,app_settings',
            'status' => 'sometimes',
            'map_api_key_server' => 'required_if:party_name,google_map|string',
            'map_api_key_client' => 'required_if:party_name,google_map|string',
            'server_key' => 'nullable|string',
            'service_file' => 'required_if:party_name,push_notification|file|mimes:json|max:'. uploadMaxFileSizeInKB('file'),
            'service_file_content' => 'required_if:party_name,firebase|string',
            'apiKey' => 'required_if:party_name,firebase|string',
            'authDomain' => 'required_if:party_name,firebase|string',
            'projectId' => 'required_if:party_name,firebase|string',
            'storageBucket' => 'required_if:party_name,firebase|string',
            'messagingSenderId' => 'required_if:party_name,firebase|string',
            'appId' => 'required_if:party_name,firebase|string',
            'measurementId' => 'nullable|string',
            'web_api_key' => 'required_if:party_name,firebase_otp_verification|string',
            'site_key' => 'required_if:party_name,recaptcha|string',
            'secret_key' => 'required_if:party_name,recaptcha|string',
            'client_id' => 'required_if:party_name,apple_login|string',
            'team_id' => 'required_if:party_name,apple_login|string',
            'key_id' => 'required_if:party_name,apple_login|string',
            'apple_service_file' => 'nullable|file|extensions:p8|max:'. uploadMaxFileSizeInKB('file'),
            'mailer_name' => 'required_if:party_name,email_config|string',
            'host' => 'required_if:party_name,email_config|string',
            'driver' => 'required_if:party_name,email_config|string',
            'port' => 'required_if:party_name,email_config|integer',
            'user_name' => 'required_if:party_name,email_config|string',
            'email_id' => 'required_if:party_name,email_config|email',
            'encryption' => 'required_if:party_name,email_config|string',
            'password' => 'required_if:party_name,email_config|string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response: response()->json(response_formatter(constant: DEFAULT_400, errors: error_processor($validator))));
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->has('status') ? 1 : 0,
        ]);
    }
}
