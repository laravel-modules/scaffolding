<?php

namespace App\Http\Controllers\Accounts;

use App\Models\User;
use Illuminate\Routing\Controller;
use App\Http\Resources\SelectResource;
use App\Http\Filters\Accounts\SelectFilter;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Accounts\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $users = User::filter($filter)->paginate();

        return SelectResource::collection($users);
    }
}
