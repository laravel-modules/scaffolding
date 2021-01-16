<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laraeast\LaravelSettings\Models\Setting as BaseSettingModel;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;

class Setting extends BaseSettingModel implements HasMedia
{
    use InteractsWithMedia;
    use HasUploader;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
        $this->addMediaCollection('favicon')->singleFile();
    }
}
