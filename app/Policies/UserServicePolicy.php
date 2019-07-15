<?php

namespace SavyCon\Policies;

use SavyCon\Models\User;
use SavyCon\Models\UserService;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserServicePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any user services.
     *
     * @param  \SavyCon\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the user service.
     *
     * @param  \SavyCon\Models\User  $user
     * @param  \SavyCon\UserService  $userService
     * @return mixed
     */
    public function view(User $user, UserService $userService)
    {
        //
    }

    /**
     * Determine whether the user can create user services.
     *
     * @param  \SavyCon\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user service.
     *
     * @param  \SavyCon\Models\User  $user
     * @param  \SavyCon\UserService  $userService
     * @return mixed
     */
    public function update(User $user, UserService $userService)
    {
        return $user->id === $userService->user_id;
    }

    /**
     * Determine whether the user can delete the user service.
     *
     * @param  \SavyCon\Models\User  $user
     * @param  \SavyCon\UserService  $userService
     * @return mixed
     */
    public function delete(User $user, UserService $userService)
    {
        //
    }

    /**
     * Determine whether the user can restore the user service.
     *
     * @param  \SavyCon\Models\User  $user
     * @param  \SavyCon\UserService  $userService
     * @return mixed
     */
    public function restore(User $user, UserService $userService)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user service.
     *
     * @param  \SavyCon\Models\User  $user
     * @param  \SavyCon\UserService  $userService
     * @return mixed
     */
    public function forceDelete(User $user, UserService $userService)
    {
        //
    }
}
