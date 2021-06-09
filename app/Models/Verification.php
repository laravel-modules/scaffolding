<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property \Carbon\Carbon $created_at
 */
class Verification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'phone',
        'code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determine whither the verification code is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->updated_at->addMinutes(5)->isPast();
    }
}
