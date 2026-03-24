<?php

namespace Modules\ProviderManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasUuid;
use Modules\TransactionModule\Entities\WithdrawalMethod;

class ProvidersWithdrawMethodsData extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'providers_withdraw_methods_data';

    protected $fillable = [
        'id',
        'provider_id',
        'withdrawal_method_id',
        'method_name',
        'method_field_data',
        'is_default',
        'is_active',
    ];

    protected $casts = [
        'method_field_data' => 'array',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function withdrawalMethod()
    {
        return $this->belongsTo(WithdrawalMethod::class, 'withdrawal_method_id');
    }

    protected function scopeOfStatus($query, $status)
    {
        $query->where('is_active', $status);
    }
}
