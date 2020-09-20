<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPasswordCode extends Model
{
    /**
     * the code expiration by seconds.
     *
     * @var int
     */
    const EXPIRE_DURATION = 10 * 60;

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'code',
    ];

    /**
     * Determine whither this code has been expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->created_at->addSeconds(static::EXPIRE_DURATION)->isPast();
    }
}
