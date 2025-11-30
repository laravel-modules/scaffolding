<?php

namespace App\Models;

use AhmedAliraqi\LaravelFilterable\Filterable;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use App\Http\Filters\UserFilter;
use App\Http\Resources\CustomerResource;
use App\Models\Contracts\NotificationTarget;
use App\Models\Helpers\UserHelpers;
use App\Models\Presenters\UserPresenter;
use App\Support\Traits\Selectable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laracasts\Presenter\PresentableTrait;
use Laravel\Sanctum\HasApiTokens;
use Parental\HasChildren;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, NotificationTarget
{
    use Filterable;
    use HasApiTokens;
    use HasChildren;
    use HasFactory;
    use HasRoles;
    use HasUploader;
    use Impersonate;
    use InteractsWithMedia;
    use Notifiable;
    use PresentableTrait;
    use Selectable;
    use UserHelpers;

    /**
     * The code of admin type.
     *
     * @var string
     */
    const ADMIN_TYPE = 'admin';

    /**
     * The code of supervisor type.
     *
     * @var string
     */
    const SUPERVISOR_TYPE = 'supervisor';

    /**
     * The code of customer type.
     *
     * @var string
     */
    const CUSTOMER_TYPE = 'customer';

    /**
     * The guard name of the user permissions.
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'remember_token',
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
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $childTypes = [
        self::ADMIN_TYPE => Admin::class,
        self::SUPERVISOR_TYPE => Supervisor::class,
        self::CUSTOMER_TYPE => Customer::class,
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
     * The model filter name.
     *
     * @var string
     */
    protected $filter = UserFilter::class;

    /**
     * Get the dashboard profile link.
     */
    public function dashboardProfile(): string
    {
        return '#';
    }

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
     * Get the resource for customer type.
     *
     * @return \App\Http\Resources\CustomerResource
     */
    public function getResource()
    {
        return new CustomerResource($this);
    }

    /**
     * Get the access token currently associated with the user. Create a new.
     *
     * @param  string|null  $device
     * @return string
     */
    public function createTokenForDevice($device = null)
    {
        $device = $device ?: 'Unknown Device';

        $this->tokens()->where('name', $device)->delete();

        return $this->createToken($device)->plainTextToken;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fcmTokens()
    {
        return $this->hasMany(FcmToken::class, 'user_id');
    }

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->fcmTokens()->pluck('token')->toArray();
    }

    /**
     * Define the media collections.
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatars')
            ->useFallbackUrl('https://www.gravatar.com/avatar/'.md5($this->email ?: '').'?d=mm')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(70)
                    ->format('png');

                $this->addMediaConversion('small')
                    ->width(120)
                    ->format('png');

                $this->addMediaConversion('medium')
                    ->width(160)
                    ->format('png');

                $this->addMediaConversion('large')
                    ->width(320)
                    ->format('png');
            });
    }

    /**
     * Determine whither the user can impersonate another user.
     *
     * @return bool
     */
    public function canImpersonate()
    {
        return $this->isAdmin();
    }

    /**
     * Determine whither the user can be impersonated by the admin.
     *
     * @return bool
     */
    public function canBeImpersonated()
    {
        return $this->isSupervisor();
    }

    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(NotificationModel::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    /**
     * The title of the notification.
     */
    public function getNotificationTitle(NotificationModel $notification): string
    {
        return $this->name;
    }

    /**
     * The body of the notification.
     */
    public function getNotificationBody(NotificationModel $notification): string
    {
        if ($notification->user->isCustomer()) {
            return trans('notifications.new-customer', [
                'user' => $this->name,
            ]);
        }

        return __('New user has been registered.');
    }

    /**
     * The image of the notification.
     */
    public function getNotificationImage(NotificationModel $notification): string
    {
        return $this->getAvatar();
    }

    /**
     * The data of the notification.
     *
     * @return mixed|void
     */
    public function getNotificationData(NotificationModel $notification)
    {
        return $this->getResource();
    }

    /**
     * The dashboard url of the notification.
     */
    public function getNotificationDashboardUrl(NotificationModel $notification): string
    {
        $parameters = [
            $this,
            'notification_id' => $notification->id,
            'action' => 'delete',
        ];

        if ($this->isAdmin()) {
            return route('dashboard.admins.show', $parameters);
        }

        if ($this->isSupervisor()) {
            return route('dashboard.supervisors.show', $parameters);
        }

        return route('dashboard.customers.show', $parameters);
    }
}
