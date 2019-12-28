<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id', 'academic_rank_id', 'degree_id', 'specialization_id', 'faculty_id'
    ];
    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Summary of academicRank
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academicRank()
    {
        return $this->belongsTo(AcademicRank::class);
    }
    /**
     * Summary of degree
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
    /**
     * Summary of specialization
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
    /**
     * Summary of faculty
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    /**
     * Summary of courseClasses
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseClasses()
    {
        return $this->hasMany(CourseClass::class);
    }

    public static function meta()
    {
        $data = [];
        $faculties = Faculty::all();
        $data['faculties'] = $faculties;
        $academicrank = AcademicRank::all();
        $data['academicranks'] = $academicrank;
        $degrees = Degree::all();
        $data['degrees'] = $degrees;
        return $data;
    }
}
