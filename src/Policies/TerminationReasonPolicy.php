<?php

namespace Dainsys\HumanResource\Policies;

use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Dainsys\HumanResource\Models\TerminationReason;
use Dainsys\HumanResource\Policies\Traits\HasAdminCheck;

class TerminationReasonPolicy
{
    use HasAdminCheck;
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\TerminationReason           $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TerminationReason $site)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\TerminationReason           $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TerminationReason $site)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\TerminationReason           $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TerminationReason $site)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\TerminationReason           $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TerminationReason $site)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\TerminationReason           $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TerminationReason $site)
    {
        return false;
    }
}
