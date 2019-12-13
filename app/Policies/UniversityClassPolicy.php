<?php

namespace App\Policies;

use App\Models\UniversityClass;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UniversityClassPolicy
{
    use HandlesAuthorization;
    /**
     * Summary of before
     * @param mixed $user 
     * @param mixed $ability 
     * @return bool|null
     */
    public function before($user, $ability)
    {
        if ($user->roles->isAdmin()) {
            return true;
        }
        if(!$user->roles->isAdmin() && !$user->roles->isTeacher())
        {
            return false;
        }
        return null;
    }
    /**
     * Determine whether the user can view any university classes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the university class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UniversityClass  $universityClass
     * @return mixed
     */
    public function view(User $user, UniversityClass $universityClass)
    {
        return true;
    }

    /**
     * Determine whether the user can create university classes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the university class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UniversityClass  $universityClass
     * @return mixed
     */
    public function update(User $user, UniversityClass $universityClass)
    {
        //
    }

    /**
     * Determine whether the user can delete the university class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UniversityClass  $universityClass
     * @return mixed
     */
    public function delete(User $user, UniversityClass $universityClass)
    {
        //
    }

    /**
     * Determine whether the user can restore the university class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UniversityClass  $universityClass
     * @return mixed
     */
    public function restore(User $user, UniversityClass $universityClass)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the university class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UniversityClass  $universityClass
     * @return mixed
     */
    public function forceDelete(User $user, UniversityClass $universityClass)
    {
        //
    }
}
