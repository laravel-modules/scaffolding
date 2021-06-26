<?php

namespace App\Models;

use App\Models\Contracts\NotificationTarget;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationModel extends DatabaseNotification
{
    use HasFactory;

    /**
     * The code of registered notification type.
     *
     * @var mixed
     */
    const REGISTERED_TYPE = 0;

    /**
     * The code of feedback notification type.
     *
     * @var mixed
     */
    const FEEDBACK_TYPE = 1;

    /**
     * The foreign key columns that should be synced from data.
     *
     * @var string[]
     */
    protected static $foreignKeyColumns = [
        'user_id',
        'feedback_id',
    ];

    /**
     * Retrieve the notification target instance.
     *
     * @return \App\Models\Contracts\NotificationTarget
     */
    public function target(): NotificationTarget
    {
        switch ($this->data['type'] ?? null) {
            case self::FEEDBACK_TYPE:
                return $this->feedback;
            case self::REGISTERED_TYPE:
            default:
                return $this->user;
        }
    }

    /**
     * The user who associated the notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The feedback that associated the notification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'feedback_id')->withTrashed();
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function (self $notification) {
            foreach (self::$foreignKeyColumns as $foreignKeyColumn) {
                if (isset($notification->data[$foreignKeyColumn])) {
                    $notification->forceFill([
                        $foreignKeyColumn => $notification->data[$foreignKeyColumn],
                    ]);
                }
            }
        });
    }
}
