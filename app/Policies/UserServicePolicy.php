<?php

namespace SavyCon\Policies;

use SavyCon\Models\User;
use SavyCon\Models\UserService;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserServicePolicy
{
    use HandlesAuthorization;

    public function updateService(User $user, UserService $userService)
    {
        return $user->id === $userService->user_id;
    }
}
