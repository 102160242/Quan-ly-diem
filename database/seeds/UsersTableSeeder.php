<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 100)->create()->each(function ($user) {
            $user->roles()->setTeacher(rand(0, 1));
        });
    }
}
