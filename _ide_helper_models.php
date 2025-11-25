<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $firebase_id
 * @property string|null $phone_verified_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FcmToken> $fcmTokens
 * @property-read int|null $fcm_tokens_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \App\Models\NotificationModel> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\AdminFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin filter(?\App\Http\Filters\BaseFilters $filters = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin sortingByIds($ids)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereFirebaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin withoutTrashed()
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $firebase_id
 * @property string|null $phone_verified_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FcmToken> $fcmTokens
 * @property-read int|null $fcm_tokens_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \App\Models\NotificationModel> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\CustomerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer filter(?\App\Http\Filters\BaseFilters $filters = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer sortingByIds($ids)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereFirebaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FcmToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FcmToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FcmToken query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FcmToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FcmToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FcmToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FcmToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FcmToken whereUserId($value)
 */
	class FcmToken extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\FeedbackFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback filter(?\App\Http\Filters\BaseFilters $filters = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback sortingByIds($ids)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback unread()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback withoutTrashed()
 */
	class Feedback extends \Eloquent implements \App\Models\Contracts\NotificationTarget {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property array<array-key, mixed> $data
 * @property int|null $user_id
 * @property int|null $feedback_id
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Feedback|null $feedback
 * @property-read \Illuminate\Database\Eloquent\Model $notifiable
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> all($columns = ['*'])
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel read()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel unread()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereFeedbackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotificationModel whereUserId($value)
 */
	class NotificationModel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $key
 * @property string|null $locale
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereValue($value)
 */
	class Setting extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $firebase_id
 * @property string|null $phone_verified_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FcmToken> $fcmTokens
 * @property-read int|null $fcm_tokens_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \App\Models\NotificationModel> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\SupervisorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor filter(?\App\Http\Filters\BaseFilters $filters = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor sortingByIds($ids)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereFirebaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supervisor withoutTrashed()
 */
	class Supervisor extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $firebase_id
 * @property string|null $phone_verified_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FcmToken> $fcmTokens
 * @property-read int|null $fcm_tokens_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \App\Models\NotificationModel> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User filter(?\App\Http\Filters\BaseFilters $filters = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User sortingByIds($ids)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirebaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \App\Models\Contracts\NotificationTarget {}
}

namespace App\Models{
/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Verification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Verification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Verification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Verification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Verification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Verification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Verification wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Verification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Verification whereUserId($value)
 */
	class Verification extends \Eloquent {}
}

