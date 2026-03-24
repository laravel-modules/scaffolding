<?php

namespace App\Emails\Models;

use App\Emails\Enums\EmailStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Email extends Model
{
    protected $fillable = [
        'model_type',
        'model_id',
        'email',
        'name',
        'subject',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => EmailStatus::class,
    ];

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }
}
