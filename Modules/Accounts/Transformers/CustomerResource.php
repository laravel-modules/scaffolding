<?php

namespace Modules\Accounts\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Accounts\Entities\Customer */
class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            'avatar' => $this->getAvatar(),
            'localed_type' => $this->present()->type,
            'created_at' => $this->created_at->toDateTimeString(),
            'created_at_formated' => $this->created_at->diffForHumans(),
        ];
    }
}
