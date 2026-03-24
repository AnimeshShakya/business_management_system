<?php

namespace Modules\CustomerModule\Entities;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscribeNewsletter extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'subscribe_newsletters';

    protected $casts = [
        'email' => 'string',
    ];

    protected $fillable = ['email'];

    protected static function newFactory()
    {
        return \Modules\CustomerModule\Database\factories\SubscribeNewsletterFactory::new();
    }
}
