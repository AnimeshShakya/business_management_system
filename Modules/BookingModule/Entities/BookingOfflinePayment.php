<?php

namespace Modules\BookingModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasUuid;

class BookingOfflinePayment extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'booking_id',
        'offline_payment_id',
        'customer_information',
        'method_name',
        'payment_status',
        'denied_note',
    ];
    protected $casts = [
        'customer_information' => 'array',
    ];

    protected static function newFactory()
    {
        return \Modules\BookingModule\Database\factories\BookingOfflinePaymentFactory::new();
    }
}
