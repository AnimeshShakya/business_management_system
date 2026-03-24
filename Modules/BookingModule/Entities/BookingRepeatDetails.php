<?php

namespace Modules\BookingModule\Entities;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\ServiceManagement\Entities\Service;

class BookingRepeatDetails extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\BookingModule\Database\factories\BookingRepeatDetailsFactory::new();
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function repeat(): BelongsTo
    {
        return $this->belongsTo(BookingRepeat::class, 'booking_repeat_id');
    }
}
