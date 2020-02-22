<?php

namespace App\Models\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * Display the localed type.
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function type()
    {
        return trans('users.types.'.$this->entity->type);
    }
}
