<?php

namespace App\Models;

use AhmedAliraqi\LaravelFilterable\Filterable;
use App\Http\Filters\FeedbackFilter;
use App\Models\Contracts\NotificationTarget;
use App\Support\Traits\Selectable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model implements NotificationTarget
{
    use Filterable;
    use HasFactory;
    use Selectable;
    use SoftDeletes;

    /**
     * The query parameter's filter of the model.
     *
     * @var string
     */
    protected $filter = FeedbackFilter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'read_at' => 'datetime',
    ];

    /**
     * Determine whither the message was read.
     *
     * @return bool
     */
    public function read()
    {
        return (bool) $this->read_at;
    }

    /**
     * Mark the message as read.
     *
     * @return $this
     */
    public function markAsRead()
    {
        if (! $this->read()) {
            $this->forceFill(['read_at' => now()])->save();
        }

        return $this;
    }

    /**
     * Mark the message as unread.
     *
     * @return $this
     */
    public function markAsUnread()
    {
        if ($this->read()) {
            $this->forceFill(['read_at' => null])->save();
        }

        return $this;
    }

    /**
     * Scope the query to include only unread messages.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
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
        return trans('notifications.new-feedback', [
            'user' => $this->name,
        ]);
    }

    /**
     * The image of the notification.
     */
    public function getNotificationImage(NotificationModel $notification): string
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email).'?d=mm';
    }

    /**
     * The data of the notification.
     *
     * @return mixed|void
     */
    public function getNotificationData(NotificationModel $notification)
    {
        //
    }

    /**
     * The dashboard url of the notification.
     */
    public function getNotificationDashboardUrl(NotificationModel $notification): string
    {
        return route('dashboard.feedback.show', [
            $this,
            'notification_id' => $notification->id,
            'action' => 'delete',
        ]);
    }
}
