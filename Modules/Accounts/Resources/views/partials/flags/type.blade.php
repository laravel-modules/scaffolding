@switch($user->type)
    @case(\Modules\Accounts\Entities\User::SUPERVISOR_TYPE)
    <span class="badge badge-success">{{ $user->present()->type }}</span>
    @break
    @case(\Modules\Accounts\Entities\User::ADMIN_TYPE)
    <span class="badge text-white bg-purple">{{ $user->present()->type }}</span>
    @break
@endswitch
