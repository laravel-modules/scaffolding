<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SelectResource;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function select()
    {
        $users = User::filter()->paginate();

        return SelectResource::collection($users);
    }
}
