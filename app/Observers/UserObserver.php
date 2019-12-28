<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserRole;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        // Khoi tao quyen User trong bang UserRoles
        UserRole::create([
            'user_id' => $user->id,
            'is_admin' => false,
            'is_teacher' => false
        ]);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {

    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
    public function deleleting(User $user)
    {
        $user->roles->delete();
        if(!!$user->teacherProfile)
            $user->teacherProfile->delete();
    }
}
