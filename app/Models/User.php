<?php

namespace App\Models;

use Parental\HasChildren;
use Laravel\Passport\HasApiTokens;
use App\Models\Helpers\UserHelpers;
use App\Models\Concerns\HasMediaTrait;
use App\Models\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable,
        UserHelpers,
        HasChildren,
        HasMediaTrait,
        HasApiTokens,
        HasChildren;

    /**
     * The code of the admin type.
     *
     * @var string
     */
    const ADMIN_TYPE = 'admin';

    /**
     * The code of the user type.
     *
     * @var string|null
     */
    const USER_TYPE = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

    /**
     * @var array
     */
    protected $childTypes = [
        'admin' => Admin::class,
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
