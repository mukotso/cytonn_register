<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function update()
    {
        $user=Auth::user();
        return $user->is_admin == true
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }
}
