<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $user = Auth::user();
        switch($request->get('fileType'))
        {
            case "csv":
                $fileType = \Maatwebsite\Excel\Excel::CSV;
                break;
            case "html";
                $fileType = \Maatwebsite\Excel\Excel::HTML;
                break;
            case "xls":
                $fileType = \Maatwebsite\Excel\Excel::XLS;
                break;
            default:
                $fileType = \Maatwebsite\Excel\Excel::XLSX;
        }

        $id = md5(rand());
        $filename = "export\\". $id .".xlsx";

        switch($request->get('table'))
        {
            case "students":
                (new \App\Exports\StudentsExport)->store($filename, null, $fileType)->chain([
                    (new \App\Jobs\NotifyUserOfCompletedExport($user->email, $filename, "Danh sách Sinh Viên.".mb_strtolower($fileType)))
                ]);
                break;
            case "university_classes":
                (new \App\Exports\UniversityClassesExport)->store($filename, null, $fileType)->chain([
                    (new \App\Jobs\NotifyUserOfCompletedExport($user->email, $filename, "Danh sách Lớp Sinh Hoạt.".mb_strtolower($fileType)))
                ]);
                break;
            case "users":
                (new \App\Exports\UsersExport)->store($filename, null, $fileType)->chain([
                    (new \App\Jobs\NotifyUserOfCompletedExport($user->email, $filename, "Danh sách Nhân Sự.".mb_strtolower($fileType)))
                ]);
                break;
            case "courses":
                (new \App\Exports\CoursesExport)->store($filename, null, $fileType)->chain([
                    (new \App\Jobs\NotifyUserOfCompletedExport($user->email, $filename, "Danh sách Học Phần.".mb_strtolower($fileType)))
                ]);
                break;
            case "course_classes":
                (new \App\Exports\CourseClassesExport)->store($filename, null, $fileType)->chain([
                    (new \App\Jobs\NotifyUserOfCompletedExport($user->email, $filename, "Danh sách Lớp Học Phần.".mb_strtolower($fileType)))
                ]);
                break;
            default:
                return response()->error("Yêu cầu không hợp lệ!");
        }

        return response()->success([], "Đã bắt đầu quá trình Export, bạn sẽ được gửi mail thông báo sau khi quá trình hoàn tất!");
    }
}
