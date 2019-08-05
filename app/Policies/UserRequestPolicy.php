<?php

namespace SavyCon\Policies;

use SavyCon\Models\User;
use SavyCon\Models\UserRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserRequestPolicy
{
    use HandlesAuthorization;

    public function updateRequest(User $user, UserRequest $userRequest)
    {
        return $user->id === $userRequest->user_id;
    }
}
