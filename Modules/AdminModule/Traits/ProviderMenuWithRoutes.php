<?php

namespace Modules\AdminModule\Traits;

trait ProviderMenuWithRoutes
{
    public function ProviderMenuWithRoutes(): array
    {
        return [
            [
                "page_title" => "Dashboard",
                "page_title_value" => "Dashboard",
                "key" => base64_encode('provider/dashboard'),
                "uri" => "provider/dashboard",
                "full_route" => url('provider/dashboard'),
                "uri_count" => count(explode('/', 'provider/dashboard')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "Dashboard",
                "type" => "menu"
            ],
            [
                "page_title" => "Customized_requests",
                "page_title_value" => "Customized_requests",
                "key" => base64_encode('provider/booking/post?type=all&service_type=all'),
                "uri" => "provider/booking/post?type=all&service_type=all",
                "full_route" => url('provider/booking/post?type=all&service_type=all'),
                "uri_count" => count(explode('/', 'provider/booking/post?type=all&service_type=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "bookings",
                "type" => "menu"
            ],
            [
                "page_title" => "Booking_requests",
                "page_title_value" => "Booking_requests",
                "key" => base64_encode('provider/booking/list?booking_status=pending&service_type=all'),
                "uri" => "provider/booking/list?booking_status=pending&service_type=all",
                "full_route" => url('provider/booking/list?booking_status=pending&service_type=all'),
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=pending&service_type=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "bookings",
                "type" => "menu"
            ],
            [
                "page_title" => "Accepted",
                "page_title_value" => "Accepted",
                "key" => base64_encode('provider/booking/list?booking_status=accepted&service_type=all'),
                "uri" => "provider/booking/list?booking_status=accepted&service_type=all",
                "full_route" => url('provider/booking/list?booking_status=accepted&service_type=all'),
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=accepted&service_type=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "Accepted,Bookings",
                "type" => "menu"
            ],
            [
                "page_title" => "Ongoing",
                "page_title_value" => "Ongoing",
                "key" => base64_encode('provider/booking/list?booking_status=ongoing&service_type=all'),
                "uri" => "provider/booking/list?booking_status=ongoing&service_type=all",
                "full_route" => url('provider/booking/list?booking_status=ongoing&service_type=all'),
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=ongoing&service_type=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "ongoing,Bookings",
                "type" => "menu"
            ],
            [
                "page_title" => "completed",
                "page_title_value" => "completed",
                "key" => base64_encode('provider/booking/list?booking_status=completed&service_type=all'),
                "uri" => "provider/booking/list?booking_status=completed&service_type=all",
                "full_route" => url('provider/booking/list?booking_status=completed&service_type=all'),
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=completed&service_type=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "completed,Bookings",
                "type" => "menu"
            ],
            [
                "page_title" => "canceled",
                "page_title_value" => "canceled",
                "key" => base64_encode('provider/booking/list?booking_status=canceled&service_type=all'),
                "uri" => "provider/booking/list?booking_status=canceled&service_type=all",
                "full_route" => url('provider/booking/list?booking_status=canceled&service_type=all'),
                "uri_count" => count(explode('/', 'provider/booking/list?booking_status=canceled&service_type=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "canceled,Bookings",
                "type" => "menu"
            ],
            [
                "page_title" => "Chatting",
                "page_title_value" => "Chatting",
                "key" => base64_encode('provider/chat/index?user_type=super_admin'),
                "uri" => "provider/chat/index?user_type=super_admin",
                "full_route" => url('provider/chat/index?user_type=super_admin'),
                "uri_count" => count(explode('/', 'provider/chat/index?user_type=super_admin')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "Chatting",
                "type" => "menu"
            ],
            [
                "page_title" => "Available_services",
                "page_title_value" => "Available_services",
                "key" => base64_encode('provider/service/available'),
                "uri" => "provider/service/available",
                "full_route" => url('provider/service/available'),
                "uri_count" => count(explode('/', 'provider/service/available')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "available services",
                "type" => "menu"
            ],
            [
                "page_title" => "My_Subscriptions",
                "page_title_value" => "My_Subscriptions",
                "key" => base64_encode('provider/sub-category/subscribed?status=all'),
                "uri" => "provider/sub-category/subscribed?status=all",
                "full_route" => url('provider/sub-category/subscribed?status=all'),
                "uri_count" => count(explode('/', 'provider/sub-category/subscribed?status=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "My subscriptions",
                "type" => "menu"
            ],
            [
                "page_title" => "Service_Requests",
                "page_title_value" => "Service_Requests",
                "key" => base64_encode('provider/service/request-list'),
                "uri" => "provider/service/request-list",
                "full_route" => url('provider/service/request-list'),
                "uri_count" => count(explode('/', 'provider/service/request-list')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "Service Requests",
                "type" => "menu"
            ],
            [
                "page_title" => "Ads_list",
                "page_title_value" => "Ads_list",
                "key" => base64_encode('provider/advertisements/ads-list?status=all'),
                "uri" => "provider/advertisements/ads-list?status=all",
                "full_route" => url('provider/advertisements/ads-list?status=all'),
                "uri_count" => count(explode('/', 'provider/advertisements/ads-list?status=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "advertisements",
                "type" => "menu"
            ],
            [
                "page_title" => "Create_new_advertisements",
                "page_title_value" => "Create_new_advertisements",
                "key" => base64_encode('provider/advertisements/ads-create'),
                "uri" => "provider/advertisements/ads-create",
                "full_route" => url('provider/advertisements/ads-create'),
                "uri_count" => count(explode('/', 'provider/advertisements/ads-create')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "advertisements",
                "type" => "menu"
            ],
            [
                "page_title" => "Serviceman_list",
                "page_title_value" => "Serviceman_list",
                "key" => base64_encode('provider/serviceman/list?status=all'),
                "uri" => "provider/serviceman/list?status=all",
                "full_route" => url('provider/serviceman/list?status=all'),
                "uri_count" => count(explode('/', 'provider/serviceman/list?status=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "User",
                "type" => "menu"
            ],
            [
                "page_title" => "add_new_service_man",
                "page_title_value" => "add_new_service_man",
                "key" => base64_encode('provider/serviceman/create'),
                "uri" => "provider/serviceman/create",
                "full_route" => url('provider/serviceman/create'),
                "uri_count" => count(explode('/', 'provider/serviceman/create')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "Serviceman",
                "type" => "menu"
            ],
            [
                "page_title" => "account_information",
                "page_title_value" => "account_information",
                "key" => base64_encode('provider/account-info?page_type=overview'),
                "uri" => "provider/account-info?page_type=overview",
                "full_route" => url('provider/account-info?page_type=overview'),
                "uri_count" => count(explode('/', 'provider/account-info?page_type=overview')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "account",
                "type" => "menu"
            ],
            [
                "page_title" => "Bank_information",
                "page_title_value" => "Bank_information",
                "key" => base64_encode('provider/bank-info'),
                "uri" => "provider/bank-info",
                "full_route" => url('provider/bank-info'),
                "uri_count" => count(explode('/', 'provider/bank-info')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "account",
                "type" => "menu"
            ],
            [
                "page_title" => "Transaction_report",
                "page_title_value" => "Transaction_report",
                "key" => base64_encode('provider/report/transaction?transaction_type=all'),
                "uri" => "provider/report/transaction?transaction_type=all",
                "full_route" => url('provider/report/transaction?transaction_type=all'),
                "uri_count" => count(explode('/', 'provider/report/transaction?transaction_type=all')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "reports",
                "type" => "menu"
            ],
            [
                "page_title" => "Business_report",
                "page_title_value" => "Business_report",
                "key" => base64_encode('provider/report/business/overview'),
                "uri" => "provider/report/business/overview",
                "full_route" => url('provider/report/business/overview'),
                "uri_count" => count(explode('/', 'provider/report/business/overview')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "reports",
                "type" => "menu"
            ],
            [
                "page_title" => "Booking_report",
                "page_title_value" => "Booking_report",
                "key" => base64_encode('provider/report/booking'),
                "uri" => "provider/report/booking",
                "full_route" => url('provider/report/booking'),
                "uri_count" => count(explode('/', 'provider/report/booking')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "reports",
                "type" => "menu"
            ],
            [
                "page_title" => "Business_Settings",
                "page_title_value" => "Business_Settings",
                "key" => base64_encode('provider/business-settings/get-business-information'),
                "uri" => "provider/business-settings/get-business-information",
                "full_route" => url('provider/business-settings/get-business-information'),
                "uri_count" => count(explode('/', 'provider/business-settings/get-business-information')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "system management",
                "type" => "menu"
            ],
            [
                "page_title" => "Business_plan",
                "page_title_value" => "Business_plan",
                "key" => base64_encode('provider/subscription-package/details'),
                "uri" => "provider/subscription-package/details",
                "full_route" => url('provider/subscription-package/details'),
                "uri_count" => count(explode('/', 'provider/subscription-package/details')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "system management",
                "type" => "menu"
            ],
            [
                "page_title" => "Payment_information",
                "page_title_value" => "Payment_information",
                "key" => base64_encode('provider/settings/payment-information/index'),
                "uri" => "provider/settings/payment-information/index",
                "full_route" => url('provider/settings/payment-information/index'),
                "uri_count" => count(explode('/', 'provider/settings/payment-information/index')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "system management",
                "type" => "menu"
            ],
            [
                "page_title" => "Notification_channel",
                "page_title_value" => "Notification_channel",
                "key" => base64_encode('provider/configuration/get-notification-setting?notification_type=provider'),
                "uri" => "provider/configuration/get-notification-setting?notification_type=provider",
                "full_route" => url('provider/configuration/get-notification-setting?notification_type=provider'),
                "uri_count" => count(explode('/', 'provider/configuration/get-notification-setting?notification_type=provider')),
                "method" => "GET",
                "priority" => 1,
                "keywords" => "system management",
                "type" => "menu"
            ],
        ];
    }
}
