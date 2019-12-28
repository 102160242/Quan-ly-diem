<?php

namespace App\Observers;

use App\Models\UserRole;
use App\Models\Teacher;

class UserRoleObserver
{
    /**
     * Handle the user role "created" event.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return void
     */
    public function created(UserRole $userRole)
    {
        // Tu dong tao Profile cho giang vien khi mot user duoc doi quyen thanh giang vien
        if($userRole->is_teacher)
        {
            Teacher::create([
                'user_id' => $userRole->user_id
            ]);
        }
    }

    /**
     * Handle the user role "updated" event.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return void
     */
    public function updated(UserRole $userRole)
    {
        if(!$userRole->is_teacher)
        {
            if(!!$userRole->user->teacherProfile)
                $userRole->user->teacherProfile->delete();
        }
        else // Neu cap nhat User la giao vien thi tao profile moi
        {
            if($userRole->user->teacherProfile == null)
            {
                Teacher::create([
                    'user_id' => $userRole->user_id
                ]);
            }
        }
    }

    /**
     * Handle the user role "deleted" event.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return void
     */
    public function deleted(UserRole $userRole)
    {
        //
    }

    /**
     * Handle the user role "restored" event.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return void
     */
    public function restored(UserRole $userRole)
    {
        //
    }

    /**
     * Handle the user role "force deleted" event.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return void
     */
    public function forceDeleted(UserRole $userRole)
    {
        //
    }
}
