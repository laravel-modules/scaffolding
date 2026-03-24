<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class MailTemplateTranslation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'subject', 'content'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
