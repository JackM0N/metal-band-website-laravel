<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Concert;

class ConcertPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('concerts.index');
    }

    /**
     * Determine whether the user can manage the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function manage(User $user)
    {
        return $user->can('concerts.manage');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('concerts.manage');
    }

    public function update(User $user, Concert $concert)
    {
        return $concert->deleted_at === null
            && $user->can('concerts.manage');
    }

    public function delete(User $user, Concert $concert)
    {
        return $concert->deleted_at === null
            && $user->can('concerts.manage');
    }

    public function restore(User $user, Concert $concert)
    {
        return $concert->deleted_at !== null
            && $user->can('concerts.manage');
    }
}
