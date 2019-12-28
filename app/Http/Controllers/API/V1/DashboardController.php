<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\UniversityClass;
use App\Models\CourseClass;
use App\Models\Course;
use App\Models\Student;

class DashboardController extends Controller
{
    public function failedJobs()
    {
        return response()->success(\App\Models\FailedJob::getJobs());
    }
    public function statistics()
    {
        $data = [];
        $data["total_users"] = User::count();
        $data["total_teachers"] = Teacher::count();
        $data["total_university_classes"] = UniversityClass::count();
        $data["total_course_classes"] = CourseClass::count();
        $data["total_courses"] = Course::count();
        $data["total_students"] = Student::count();

        return response()->success($data);
    }
}
