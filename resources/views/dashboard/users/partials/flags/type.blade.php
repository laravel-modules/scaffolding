@switch($user->type)
    @case(\App\Models\User::SUPERVISOR_TYPE)
    <span class="badge badge-success">{{ $user->present()->type }}</span>
    @break
    @case(\App\Models\User::ADMIN_TYPE)
    <span class="badge text-white bg-purple">{{ $user->present()->type }}</span>
    @break
@endswitch
