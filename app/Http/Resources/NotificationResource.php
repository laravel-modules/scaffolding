<?php

namespace App\Http\Resources;

use App\Models\NotificationModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin NotificationModel */
class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->target()->getNotificationTitle($this->resource),
            'body' => $this->target()->getNotificationBody($this->resource),
            'image' => $this->target()->getNotificationImage($this->resource),
            'dashboard_url' => $this->target()->getNotificationDashboardUrl($this->resource),
            'type' => $this->data['type'] ?? null,
            'data' => $this->target()->getNotificationData($this->resource),
            'read' => (bool) $this->read_at,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
