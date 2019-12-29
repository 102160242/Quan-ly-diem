<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $softCascade = ['teacherProfile', 'roles'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'phone_number', 'birthday', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //public function isAdmin()
    //{
    //    return $this->roles()->first()->is_admin;
    //}
    //public function isTeacher()
    //{
    //    return $this->roles()->first()->is_teacher;
    //}

    //public function setAdmin($isAdmin = true)
    //{
    //    $roles = $this->roles();
    //    $roles->update(['is_admin' => $isAdmin ]);
    //}

    //public function setTeacher($isTeacher = true)
    //{
    //    $roles = $this->roles();
    //    $roles->update(['is_teacher' => $isTeacher ]);
    //}

    #region Tymon\JWTAuth\Contracts\JWTSubject Members

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    function getJWTCustomClaims()
    {
        return [];
    }

    #endregion

    /**
     * Summary of universityClasses
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function universityClasses()
    {
        return $this->belongsToMany(UniversityClass::class/*, 'class_user', 'user_id', 'class_id'*/);
    }
    /**
     * Summary of teacherProfile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacherProfile()
    {
        return $this->hasOne(Teacher::class);
    }
    /**
     * Summary of roles
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roles()
    {
        return $this->hasOne(UserRole::class);
    }
}
