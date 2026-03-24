<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laracasts\Presenter\Exceptions\PresenterException;

/** @mixin Customer */
class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     *
     * @throws PresenterException
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
            'created_at_formatted' => $this->created_at->diffForHumans(),
        ];
    }
}
