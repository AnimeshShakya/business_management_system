<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Modules\BusinessSettingsModule\Entities\BusinessPageSetting;
use Modules\BusinessSettingsModule\Entities\BusinessSettings;
use Modules\BusinessSettingsModule\Entities\DataSetting;
use Modules\BusinessSettingsModule\Entities\LoginSetup;
use Modules\UserManagement\Entities\User;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedBusinessSettings();
        $this->seedLoginSetups();
        $this->seedDataSettings();
        $this->seedBusinessPages();
        $this->seedAdminUser();
    }

    private function seedBusinessSettings(): void
    {
        if (!Schema::hasTable('business_settings')) {
            return;
        }

        $settings = [
            ['business_name', 'business_information', 'Lagankhel Demo Services', 1],
            ['country_code', 'business_information', 'NP', 1],
            ['business_address', 'business_information', 'Lagankhel, Lalitpur, Nepal', 1],
            ['business_phone', 'business_information', '+9779800000000', 1],
            ['business_email', 'business_information', 'demo@example.com', 1],
            ['address_latitude', 'business_information', 27.6667, 1],
            ['address_longitude', 'business_information', 85.3167, 1],
            ['currency_decimal_point', 'business_information', 2, 1],
            ['currency_code', 'business_information', 'NPR', 1],
            ['currency_symbol_position', 'business_information', 'left', 1],
            ['time_format', 'business_information', '24h', 1],
            ['footer_text', 'business_information', 'Demo mode enabled', 1],
            ['cookies_text', 'business_information', 'We use cookies to improve your experience.', 1],
            ['default_commission', 'business_information', 10, 1],
            ['phone_number_visibility_for_chatting', 'business_information', 0, 1],
            ['minimum_withdraw_amount', 'business_information', 10, 1],
            ['maximum_withdraw_amount', 'business_information', 1000, 1],
            ['create_user_account_from_guest_info', 'business_information', 1, 1],
            ['system_language', 'business_information', [
                ['code' => 'en', 'status' => 1, 'default' => 1, 'name' => 'English'],
                ['code' => 'ne', 'status' => 1, 'default' => 0, 'name' => 'Nepali'],
            ], 1],

            ['app_url_playstore', 'landing_button_and_links', 'https://play.google.com/store/apps/details?id=com.demo.app', 1],
            ['app_url_appstore', 'landing_button_and_links', 'https://apps.apple.com/app/id000000000', 1],
            ['web_url', 'landing_button_and_links', 'https://demo.local', 1],

            ['google_map', 'third_party', [
                'map_api_key_server' => 'demo-server-key',
                'map_api_key_client' => 'demo-client-key',
            ], 1],
            ['firebase_otp_verification', 'third_party', ['status' => 0], 1],
            ['apple_login', 'third_party', ['status' => 0], 0],

            ['email_config_status', 'email_config', 1, 1],

            ['customer_wallet', 'customer_config', 1, 1],
            ['add_to_fund_wallet', 'customer_config', 1, 1],
            ['customer_loyalty_point', 'customer_config', 1, 1],
            ['customer_referral_earning', 'customer_config', 0, 1],

            ['cash_after_service', 'service_setup', 1, 1],
            ['digital_payment', 'service_setup', 1, 1],
            ['wallet_payment', 'service_setup', 1, 1],
            ['guest_checkout', 'service_setup', 1, 1],
            ['partial_payment', 'service_setup', 0, 1],
            ['offline_payment', 'service_setup', 0, 1],
            ['partial_payment_combinator', 'service_setup', 'or', 1],
            ['sms_verification', 'service_setup', 1, 1],

            ['advanced_booking_restriction_value', 'booking_setup', 24, 1],
            ['advanced_booking_restriction_type', 'booking_setup', 'hour', 1],
            ['booking_additional_charge', 'booking_setup', 0, 1],
            ['additional_charge_label_name', 'booking_setup', 'Service charge', 1],
            ['additional_charge_fee_amount', 'booking_setup', 0, 1],
            ['booking_otp', 'booking_setup', 1, 1],
            ['instant_booking', 'booking_setup', 1, 1],
            ['schedule_booking', 'booking_setup', 1, 1],
            ['schedule_booking_time_restriction', 'booking_setup', 0, 1],
            ['max_booking_amount', 'booking_setup', 1000, 1],
            ['min_booking_amount', 'booking_setup', 5, 1],
            ['repeat_booking', 'booking_setup', 1, 1],
            ['service_complete_photo_evidence', 'booking_setup', 0, 1],

            ['otp_resend_time', 'otp_login_setup', 30, 1],

            ['provider_self_registration', 'provider_config', 1, 1],
            ['provider_commision', 'provider_config', 1, 1],
            ['provider_subscription', 'provider_config', 0, 1],
            ['provider_can_cancel_booking', 'provider_config', 1, 1],
            ['provider_self_delete', 'provider_config', 0, 1],
            ['min_payable_amount', 'provider_config', 10, 1],
            ['provider_can_edit_booking', 'provider_config', 1, 1],
            ['max_cash_in_hand_limit_provider', 'provider_config', 500, 1],
            ['suspend_on_exceed_cash_limit_provider', 'provider_config', 0, 1],
            ['provider_can_reply_review', 'provider_config', 1, 1],
            ['service_at_provider_place', 'provider_config', 1, 1],

            ['serviceman_can_cancel_booking', 'serviceman_config', 1, 1],
            ['serviceman_can_edit_booking', 'serviceman_config', 1, 1],

            ['bidding_status', 'bidding_system', 1, 1],
            ['bid_offers_visibility_for_providers', 'bidding_system', 1, 1],

            ['social_media', 'landing_social_media', [
                ['name' => 'facebook', 'icon' => 'facebook', 'link' => 'https://facebook.com', 'status' => 1],
                ['name' => 'youtube', 'icon' => 'youtube', 'link' => 'https://youtube.com', 'status' => 1],
            ], 1],

            ['customer_app_settings', 'app_settings', ['min_version_for_android' => '1.0.0', 'min_version_for_ios' => '1.0.0'], 1],
            ['provider_app_settings', 'app_settings', ['min_version_for_android' => '1.0.0', 'min_version_for_ios' => '1.0.0'], 1],
            ['serviceman_app_settings', 'app_settings', ['min_version_for_android' => '1.0.0', 'min_version_for_ios' => '1.0.0'], 1],

            ['free_trial_type', 'subscription_Setting', 'day', 1],
            ['free_trial_period', 'subscription_Setting', 14, 1],
            ['deadline_warning', 'subscription_Setting', 3, 1],
            ['deadline_warning_message', 'subscription_Setting', 'Your package is close to expiry.', 1],
            ['usage_time', 'subscription_Setting', 90, 1],

            ['terms_and_conditions', 'pages_setup', 'enabled', 1],
            ['privacy_policy', 'pages_setup', 'enabled', 1],
            ['refund_policy', 'pages_setup', 'enabled', 1],
            ['cancellation_policy', 'pages_setup', 'enabled', 1],
        ];

        foreach ($settings as [$key, $type, $liveValues, $isActive]) {
            $this->upsertBusinessSetting($key, $type, $liveValues, $isActive);
        }
    }

    private function upsertBusinessSetting(string $key, string $type, mixed $liveValues, int $isActive = 1): void
    {
        BusinessSettings::updateOrCreate(
            ['key_name' => $key, 'settings_type' => $type],
            [
                'live_values' => $liveValues,
                'test_values' => $liveValues,
                'mode' => 'live',
                'is_active' => $isActive,
            ]
        );
    }

    private function seedLoginSetups(): void
    {
        if (!Schema::hasTable('login_setups')) {
            return;
        }

        $entries = [
            'login_options' => json_encode([
                'manual_login' => 1,
                'otp_login' => 1,
                'social_media_login' => 1,
            ]),
            'social_media_for_login' => json_encode([
                'google' => 1,
                'facebook' => 1,
                'apple' => 0,
            ]),
            'email_verification' => '1',
            'phone_verification' => '1',
        ];

        foreach ($entries as $key => $value) {
            LoginSetup::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }

    private function seedDataSettings(): void
    {
        if (!Schema::hasTable('data_settings')) {
            return;
        }

        $pages = [
            ['about_us', 'About Us', 'We provide reliable home services with trained professionals.'],
            ['terms_and_conditions', 'Terms and Conditions', 'By using this demo application, you agree to the service terms.'],
            ['privacy_policy', 'Privacy Policy', 'Your personal data is handled according to this privacy policy.'],
            ['refund_policy', 'Refund Policy', 'Refunds are processed according to booking and payment status.'],
            ['return_policy', 'Return Policy', 'Return policy details for service-related products and materials.'],
            ['cancellation_policy', 'Cancellation Policy', 'Bookings can be cancelled according to configured rules.'],
        ];

        foreach ($pages as [$key, $title, $content]) {
            DataSetting::withoutGlobalScopes()->updateOrCreate(
                ['key' => $key, 'type' => 'pages_setup'],
                ['value' => $title . ': ' . $content, 'is_active' => 1]
            );
        }

        DataSetting::withoutGlobalScopes()->updateOrCreate(
            ['key' => 'newsletter_title', 'type' => 'landing_text_setup'],
            ['value' => 'Get Service Updates', 'is_active' => 1]
        );

        DataSetting::withoutGlobalScopes()->updateOrCreate(
            ['key' => 'newsletter_description', 'type' => 'landing_text_setup'],
            ['value' => 'Subscribe for booking offers, seasonal discounts, and feature updates.', 'is_active' => 1]
        );
    }

    private function seedBusinessPages(): void
    {
        if (!Schema::hasTable('business_page_settings')) {
            return;
        }

        $pages = [
            [
                'page_key' => 'safety_policy',
                'title' => 'Safety Policy',
                'content' => 'Our providers follow strict safety and hygiene standards during every service visit.',
                'is_default' => 1,
            ],
            [
                'page_key' => 'faq',
                'title' => 'Frequently Asked Questions',
                'content' => 'Find answers about bookings, payments, refunds, and account management.',
                'is_default' => 0,
            ],
        ];

        foreach ($pages as $page) {
            BusinessPageSetting::withoutGlobalScopes()->updateOrCreate(
                ['page_key' => $page['page_key']],
                [
                    'title' => $page['title'],
                    'content' => $page['content'],
                    'image' => 'def.png',
                    'is_active' => 1,
                    'is_default' => $page['is_default'],
                ]
            );
        }
    }

    private function seedAdminUser(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        $existingAdmin = User::where('user_type', 'super-admin')->first();
        if ($existingAdmin) {
            return;
        }

        User::create([
            'first_name' => 'Demo',
            'last_name' => 'Admin',
            'email' => 'admin@demo.local',
            'phone' => '+9779800000001',
            'password' => Hash::make('admin1234'),
            'is_active' => 1,
            'is_phone_verified' => 1,
            'is_email_verified' => 1,
            'user_type' => 'super-admin',
        ]);
    }
}
