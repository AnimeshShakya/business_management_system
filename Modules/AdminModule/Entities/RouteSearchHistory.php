<?php

namespace Modules\AdminModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasUuid;

class RouteSearchHistory extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'route_search_histories';


    protected $fillable = [
        'user_id',
        'user_type',
        'route_name',
        'route_uri',
        'route_full_url',
        'keyword',
        'response'
    ];

     protected $casts = [
        'response' => 'json',
    ];

    protected static function newFactory()
    {
        return \Modules\AdminModule\Database\factories\RouteSearchHistoryFactory::new();
    }
}
