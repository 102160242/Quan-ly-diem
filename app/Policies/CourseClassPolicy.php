<?php

namespace App\Policies;

use App\Models\CourseClass;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseClassPolicy
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
     * Determine whether the user can view any course classes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the course class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseClass  $courseClass
     * @return mixed
     */
    public function view(User $user, CourseClass $courseClass)
    {
        return $courseClass->teacher->user->id === $user->id; // Chi giang vien truc tiep day moi co the xem duoc
    }

    /**
     * Determine whether the user can create course classes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the course class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseClass  $courseClass
     * @return mixed
     */
    public function update(User $user, CourseClass $courseClass)
    {
        return $courseClass->teacher->user->id === $user->id;
    }

    /**
     * Determine whether the user can delete the course class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseClass  $courseClass
     * @return mixed
     */
    public function delete(User $user, CourseClass $courseClass)
    {
        //
    }

    /**
     * Determine whether the user can restore the course class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseClass  $courseClass
     * @return mixed
     */
    public function restore(User $user, CourseClass $courseClass)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the course class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseClass  $courseClass
     * @return mixed
     */
    public function forceDelete(User $user, CourseClass $courseClass)
    {
        //
    }
}
