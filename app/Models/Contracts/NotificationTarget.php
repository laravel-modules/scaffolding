<?php

namespace App\Models\Contracts;

use App\Models\NotificationModel;

interface NotificationTarget
{
    /**
     * The title of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationTitle(NotificationModel $notification): string;

    /**
     * The body of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationBody(NotificationModel $notification): string;

    /**
     * The image of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationImage(NotificationModel $notification): string;

    /**
     * The data of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return mixed|void
     */
    public function getNotificationData(NotificationModel $notification);

    /**
     * The dashboard url of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationDashboardUrl(NotificationModel $notification): string;
}