<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * Summary of $fillable
     * @var mixed
     */
    protected $fillable = [
        'user_id', 'is_teacher', 'is_admin'
    ];
    /**
     * Summary of $casts
     * @var mixed
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'is_teacher' => 'boolean'
    ];
    public function isAdmin()
    {
        return $this->is_admin;
    }
    public function isTeacher()
    {
        return $this->is_teacher;
    }
    public function setAdmin($isAdmin = true)
    {
        $this->is_admin = $isAdmin;
        $this->save();
    }
    public function unsetAdmin()
    {
        $this->is_admin = 0;
        $this->save();
    }
    public function setTeacher($isTeacher = true)
    {
        $this->is_teacher = $isTeacher;
        $this->save();
    }
    public function unsetTeacher()
    {
        $this->is_teacher = 0;
        $this->save();
    }

    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
