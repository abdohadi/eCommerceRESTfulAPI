<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $seller
     * @return mixed
     */
    public function view(User $user, User $seller)
    {
        return $user->id === $seller->id;
    }
}
