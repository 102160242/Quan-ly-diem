<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Course' => 'App\Policies\CoursePolicy',
        'App\Models\UniversityClass' => 'App\Policies\UniversityClassPolicy',
        'App\Models\CourseClass' => 'App\Policies\CourseClassPolicy',
        'App\Models\Score' => 'App\Policies\ScorePolicy',
        'App\Models\Student' => 'App\Policies\StudentPolicy',
        'App\Models\Teacher' => 'App\Policies\TeacherPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::resource('users', 'App\Policies\UserPolicy');
        Gate::resource('courses', 'App\Policies\CoursePolicy');
        Gate::resource('university_classes', 'App\Policies\UniversityClassPolicy');
        Gate::resource('course_classes', 'App\Policies\CourseClassPolicy');
        Gate::resource('scores', 'App\Policies\ScorePolicy');
        Gate::resource('students', 'App\Policies\StudentPolicy');
        Gate::resource('teachers', 'App\Policies\TeacherPolicy');
        //
    }
}
