<?php

namespace App\Traits;

use GeoIp2\Record\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;

trait FirebaseAuthTrait
{
    protected Client $client;
    public function __construct()
    {
        $this->client = new Client();
    }


    public function sendFirebaseOtp($phoneNumber): array
    {
        $fcmCredentials = BusinessSettings::where(['key_name' => 'firebase_message_config'])->first()?->live_values;

        $apiKey = $fcmCredentials['apiKey'] ?? '';
        $response = Http::post('https://identitytoolkit.googleapis.com/v1/accounts:sendVerificationCode?key=' . $apiKey, [
            'phoneNumber' => $phoneNumber,
            'recaptchaToken' => request('g-recaptcha-response') ?? session('g-recaptcha-response'),
        ]);

        $responseBody = $response->json();
        return [
            'result' => $responseBody,
            'sessionInfo' => trim($responseBody['sessionInfo'] ?? ''),
            'status' => $response->successful() ? 'success' : 'error',
            'message' => $responseBody['message'] ?? 'Something went wrong',
            'errors' => $responseBody['error']['message'] ?? null,
        ];
    }


    public function verifyFirebaseOtp($sessionInfo, $phoneNumber, $otp): array
    {
        $fcmCredentials = BusinessSettings::where(['key_name' => 'firebase_message_config'])->first()?->live_values;
        $apiKey = $fcmCredentials['apiKey'] ?? '';
        $response = Http::post('https://identitytoolkit.googleapis.com/v1/accounts:signInWithPhoneNumber?key=' . $apiKey, [
            'sessionInfo' => $sessionInfo,
            'code' => $otp,
            'phoneNumber' => $phoneNumber,
        ]);
        $responseBody = $response->json();

        return [
            'result' => $responseBody,
            'sessionInfo' => trim($responseBody['sessionInfo'] ?? ''),
            'status' => $response->successful() ? 'success' : 'error',
            'message' => $responseBody['message'] ?? 'Something went wrong',
            'errors' => $responseBody['error']['message'] ?? 'No specific error message',
        ];
    }
}
