<?php

namespace App\Policies;

use App\Models\Filter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FilterPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Filter $filter)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if (!auth()->user()->role->permissions->where('slug','filter:create' )->first()) {
            return Response::deny(  'У вас нет прав создавать');
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Filter $filter)
    {
        if (!auth()->user()->role->permissions->where('slug','filter:update' )->first()) {
            return Response::deny( 'У вас нет прав редактировать');
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Filter $filter)
    {
        if (!auth()->user()->role->permissions->where('slug','filter:delete' )->first()) {
            return Response::deny( 'У вас нет прав удалять');
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Filter $filter)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Filter $filter)
    {
        if (!auth()->user()->role->permissions->where('slug','filter:delete' )->first()) {
            return Response::deny( 'У вас нет прав удалять');
        }
        return Response::allow();
    }
}
