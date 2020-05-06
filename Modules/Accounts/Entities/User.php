<?php

namespace Modules\Accounts\Entities;

use Parental\HasChildren;
use App\Http\Filters\Filterable;
use Laravel\Passport\HasApiTokens;
use Modules\Support\Traits\HasSelect2;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Modules\Accounts\Entities\Helpers\UserHelpers;
use Modules\Accounts\Entities\Presenters\UserPresenter;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable,
        UserHelpers,
        HasChildren,
        HasMediaTrait,
        HasApiTokens,
        HasChildren,
        PresentableTrait,
        Filterable,
        HasSelect2;

    /**
     * The code of the admin type.
     *
     * @var string
     */
    const ADMIN_TYPE = 'admin';

    /**
     * The code of the supervisor type.
     *
     * @var string
     */
    const SUPERVISOR_TYPE = 'supervisor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * @var array
     */
    protected $childTypes = [
        self::ADMIN_TYPE => Admin::class,
        self::SUPERVISOR_TYPE => Supervisor::class,
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

    /**
     * The presenter class name.
     *
     * @var string
     */
    protected $presenter = UserPresenter::class;

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return request('perPage', parent::getPerPage());
    }

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('avatar')
            ->useFallbackUrl('https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm')
            ->singleFile();
    }
}
