<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Song;

class SongPolicy
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
        return $user->can('songs.index');
    }

    /**
     * Determine whether the user can manage the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function manage(User $user)
    {
        return $user->can('songs.manage');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('songs.manage');
    }

    public function update(User $user, Song $songs)
    {
        return $songs->deleted_at === null
            && $user->can('songs.manage');
    }

    public function delete(User $user, Song $song)
    {
        return $song->deleted_at === null
            && $user->can('songs.manage');
    }

    public function restore(User $user, Song $song)
    {
        return $song->deleted_at !== null
            && $user->can('songs.manage');
    }
}
