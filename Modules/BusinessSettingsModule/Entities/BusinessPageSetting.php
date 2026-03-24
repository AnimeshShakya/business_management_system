<?php

namespace Modules\BusinessSettingsModule\Entities;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class BusinessPageSetting extends Model
{
    use HasFactory, HasUuid;


    protected $table = 'business_page_settings';

    protected $fillable = [
        'page_key',
        'title',
        'content',
        'image',
        'is_active',
        'is_default',
    ];

    protected $casts = [
        'is_active' => 'integer',
        'is_default' => 'integer',
    ];

    protected $appends = ['image_full_path'];

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    public function storage()
    {
        return $this->hasOne(Storage::class, 'model_id');
    }

    public function getImageFullPathAttribute()
    {
        $image = $this->image;
        $defaultPath = asset('public/assets/admin-module/img/media/default-page.png');

        if (!$image) {
            if (request()->is('api/*')) {
                $defaultPath = asset('public/assets/admin-module/img/media/default-page.png');
            }
            return $defaultPath;
        }

        if ($image == 'def.png') {
            if (request()->is('api/*')) {
                $defaultPath = asset('public/assets/admin-module/img/media/default-page.png');
            }
            return $defaultPath;
        }

        $s3Storage = $this->storage;

        $path = 'page-setup/';
        $imagePath = $path . $image;

        return getSingleImageFullPath(imagePath: $imagePath, s3Storage: $s3Storage, defaultPath: $defaultPath, page: true);
    }

    public function getTitleAttribute($value){
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                $key = $this->page_key.'_title';
                if ($translation['key'] == $key && $translation['value'] != null) {
                    return $translation['value'];
                }
            }
        }
        return $value;
    }

    public function getContentAttribute($value){
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                $key = $this->page_key.'_content';
                if ($translation['key'] == $key && $translation['value'] != null) {
                    return $translation['value'];
                }
            }
        }
        return $value;
    }

    protected static function booted()
    {
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                return $query->where('locale', app()->getLocale());
            }]);
        });

        static::saved(function ($model) {
            $storageType = getDisk();
            if($model->isDirty('image') && $storageType != 'public'){
                saveSingleImageDataToStorage(model: $model, modelColumn : 'image', storageType : $storageType);
            }
        });

        static::deleting(function ($model) {
            $model->translations()->delete();
        });
    }
}
