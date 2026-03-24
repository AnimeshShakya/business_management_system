<?php

namespace Modules\AdminModule\Traits;

trait AdminModelWithRoutes
{
    public function getAdminModels(): array
    {
        return [
            'providers' => [
                'model' => 'Modules\ProviderManagement\Entities\Provider',
                'translationable_type' => 'Modules\ProviderManagement\Entities\Provider',
                'type' => 'providers',
                'column' => ['id', 'company_name', 'company_phone', 'company_address', 'company_email'],
                'routes' => ['admin/provider/details/{id}?web_page=overview&provider={id}','admin/provider/edit/{id}','admin/provider/list?status=all'],
                'access_type' => ['admin', 'vendor'],
                'relations' => [
                    'owner' => [
                        'columns' => ['id', 'first_name', 'last_name', 'email', 'phone'],
                        'admin_routes' => [
                            'admin/provider/details/{id}' => 'provider_details',
                        ],
                    ]
                ]
            ],
            'users' => [
                'model' => 'Modules\UserManagement\Entities\User',
                'translationable_type' => 'Modules\UserManagement\Entities\User',
                'type' => 'users',
                'column' => ['id', 'first_name', 'last_name','phone','email', 'user_type'],
                'routes' => ['admin/customer/list','admin/customer/edit/{id}','admin/customer/detail/{id}?web_page=overview'],
                'access_type' => ['admin', 'vendor']
            ],
            'bookings' => [
                'model' => 'Modules\BookingModule\Entities\Booking',
                'translationable_type' => 'Modules\BookingModule\Entities\Booking',
                'type' => 'bookings',
                'column' => ['id', 'readable_id','booking_status','is_repeated'],
                'routes' => [
                    'admin/booking/list/','admin/booking/details/{id}?web_page=details',
                ],
                'relations' => [
                    'customer' => [
                        'columns' => ['id', 'first_name', 'last_name', 'email', 'phone'],
                        'admin_routes' => [
                            'admin/booking/post?type=all' => 'Customized_Booking_Requests',
                        ],
                    ],
                    'provider' => [
                        'columns' => ['id', 'company_name', 'company_phone', 'company_email'],
                        'admin_routes' => [
                            'admin/booking/post?type=all' => 'Customized_Booking_Requests',
                        ],
                    ]
                ],
                'access_type' => ['admin', 'vendor']
            ],
            //
            'services' => [
                'model' => 'Modules\ServiceManagement\Entities\Service',
                'translationable_type' => 'Modules\ServiceManagement\Entities\Service',
                'type' => 'services',
                'column' => ['id', 'name'],
                'routes' => ['admin/service/list', 'admin/service/detail/{id}','admin/service/edit/{id}'],
                'access_type' => ['admin', 'vendor']
            ],
            'advertisements' => [
                'model' => 'Modules\PromotionManagement\Entities\Advertisement',
                'translationable_type' => 'Modules\PromotionManagement\Entities\Advertisement',
                'type' => 'advertisements',
                'column' => ['id', 'readable_id', 'title','status'],
                'routes' => ['admin/advertisements/ads-list'],
                'access_type' => ['admin', 'vendor'],

            ],
            'coupons' => [
                'model' => 'Modules\PromotionManagement\Entities\Coupon',
                'translationable_type' => 'Modules\PromotionManagement\Entities\Coupon',
                'type' => 'coupons',
                'column' => ['id', 'coupon_code','discount_id'],
                'routes' => ['admin/coupon/list', 'admin/coupon/edit/{id}'],
                'access_type' => ['admin', 'vendor'],
            ],
            'discounts' => [
                'model' => 'Modules\PromotionManagement\Entities\Discount',
                'translationable_type' => 'Modules\PromotionManagement\Entities\Discount',
                'type' => 'discounts',
                'column' => ['id', 'discount_title','promotion_type'],
                'routes' => ['admin/discount/list','admin/discount/edit/{id}'],
                'access_type' => ['admin', 'vendor'],
                'relations' => [
                    'coupons' => [
                        'columns' => ['id', 'coupon_code'],
                        'admin_routes' => [
                            'admin/coupon/list' => 'Coupon_List',
                            'admin/coupon/edit/{id}' => 'Coupon_Edit',
                        ],
                    ],
                ],
            ],
            'bonuses' => [
                'model' => 'Modules\PaymentModule\Entities\Bonus',
                'translationable_type' => 'Modules\PaymentModule\Entities\Bonus',
                'type' => 'bonuses',
                'column' => ['id', 'bonus_title'],
                'routes' => ['admin/bonus/list','admin/bonus/edit/{id}'],
                'access_type' => ['admin', 'vendor'],
            ],
            'campaigns' => [
                'model' => 'Modules\PromotionManagement\Entities\Campaign',
                'translationable_type' => 'Modules\PromotionManagement\Entities\Campaign',
                'type' => 'campaigns',
                'column' => ['id', 'campaign_name'],
                'routes' => ['admin/campaign/list', 'admin/campaign/edit/{id}'],
                'access_type' => ['admin', 'vendor'],
            ],
            'banners' => [
                'model' => 'Modules\PromotionManagement\Entities\Banner',
                'translationable_type' => 'Modules\PromotionManagement\Entities\Banner',
                'type' => 'banners',
                'column' => ['id', 'banner_title'],
                'routes' => ['admin/banner/create','admin/banner/edit/{id}'],
                'access_type' => ['admin', 'vendor'],
            ],
            'categories' => [
                'model' => 'Modules\CategoryManagement\Entities\Category',
                'translationable_type' => 'Modules\CategoryManagement\Entities\Category',
                'type' => 'categories',
                'column' => ['id', 'name','position'],
                'routes' => ['admin/category/create','admin/category/edit/{id}'],
                'access_type' => ['admin', 'vendor'],
            ],
            'subscribe_newsletters' => [
                'model' => 'Modules\CustomerModule\Entities\SubscribeNewsletter',
                'translationable_type' => 'Modules\CustomerModule\Entities\SubscribeNewsletter',
                'type' => 'subscribe_newsletters',
                'column' => ['id', 'email'],
                'routes' => ['admin/customer/newsletter/list'],
                'access_type' => ['admin', 'vendor'],
            ],
            'push_notifications' => [
                'model' => 'Modules\PromotionManagement\Entities\PushNotification',
                'translationable_type' => 'Modules\PromotionManagement\Entities\PushNotification',
                'type' => 'push_notifications',
                'column' => ['id', 'title'],
                'routes' => ['admin/push-notification/create'],
                'access_type' => ['admin', 'vendor'],
            ],
            'loyalty_point_transactions' => [
                'model' => 'Modules\TransactionModule\Entities\LoyaltyPointTransaction',
                'translationable_type' => 'Modules\TransactionModule\Entities\LoyaltyPointTransaction',
                'type' => 'loyalty_point_transactions',
                'column' => ['id', 'user_id'],
                'routes' => [],
                'relations' => [
                    'user' => [
                        'columns' => ['id', 'first_name', 'last_name', 'email', 'phone'],
                        'admin_routes' => [
                            'admin/customer/loyalty-point/report' => 'Loyalty point Report',
                        ],
                    ],
                ],
                'access_type' => ['admin', 'vendor'],
            ],
            'package_subscribers' => [
                'model' => 'Modules\BusinessSettingsModule\Entities\PackageSubscriber',
                'translationable_type' => 'Modules\BusinessSettingsModule\Entities\PackageSubscriber',
                'type' => 'package_subscribers',
                'column' => ['id', 'package_name'],
                'routes' => ['admin/subscription/subscriber/list'],
                'access_type' => ['admin', 'vendor'],
            ],   'subscription_packages' => [
                'model' => 'Modules\BusinessSettingsModule\Entities\SubscriptionPackage',
                'translationable_type' => 'Modules\BusinessSettingsModule\Entities\SubscriptionPackage',
                'type' => 'subscription_packages',
                'column' => ['id', 'name'],
                'routes' => ['admin/subscription/package/list'],
                'access_type' => ['admin', 'vendor'],
            ],
            'faqs' => [
                'model' => 'Modules\ServiceManagement\Entities\Faq',
                'translationable_type' => 'Modules\ServiceManagement\Entities\Faq',
                'type' => 'faqs',
                'column' => ['id', 'question','answer','service_id'],
                'routes' => ['admin/service/detail/{id}'],
                'access_type' => ['admin', 'vendor'],
            ],
            'business_page_settings' => [
                'model' => 'Modules\BusinessSettingsModule\Entities\BusinessPageSetting',
                'translationable_type' => 'Modules\BusinessSettingsModule\Entities\BusinessPageSetting',
                'type' => 'business_page_settings',
                'column' => ['id','title'],
                'routes' => ['admin/business-page-setup/list','admin/business-page-setup/edit/{id}'],
                'access_type' => ['admin', 'vendor'],
            ],
            "roles" => [
                'model' => 'Modules\UserManagement\Entities\Role',
                'translationable_type' => 'Modules\UserManagement\Entities\Role',
                'type' => 'roles',
                'column' => ['id', 'role_name',],
                'routes' => ['admin/role/list','admin/role/edit/{id}'],
                'access_type' => ['admin', 'vendor'],
            ]
        ];
    }
}
