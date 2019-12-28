<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('file');
        // Loai Reader
        switch($file->getClientOriginalExtension())
        {
            case "csv":
                $readerType = \Maatwebsite\Excel\Excel::CSV;
                break;
            //case "html";
            //    $readerType = \Maatwebsite\Excel\Excel::HTML;
            //    break;
            case "xls":
                $readerType = \Maatwebsite\Excel\Excel::XLS;
                break;
            default:
                $readerType = \Maatwebsite\Excel\Excel::XLSX;
        }
        switch($request->get('table'))
        {
            //$request->file('file')->getFilename();
            case "students":
                (new \App\Imports\StudentsImport)->queue($file->getPathname(), null, $readerType)->chain([
                    new \App\Jobs\NotifyUserOfCompletedImport($user->email, "Sinh Viên")
                ]);
                break;
            case "university_classes":
                (new \App\Imports\UniversityClassesImport)->queue($file->getPathname(), null, $readerType)->chain([
                    new \App\Jobs\NotifyUserOfCompletedImport($user->email, "Lớp Sinh Hoạt")
                ]);
                break;
            case "users":
                (new \App\Imports\UsersImport)->queue($file->getPathname(), null, $readerType)->chain([
                    new \App\Jobs\NotifyUserOfCompletedImport($user->email, "Nhân Sự")
                ]);
                break;
            case "courses":
                (new \App\Imports\CoursesImport)->queue($file->getPathname(), null, $readerType)->chain([
                    new \App\Jobs\NotifyUserOfCompletedImport($user->email, "Học Phần")
                ]);
                break;
            case "course_classes":
                (new \App\Imports\CourseClassesImport)->queue($file->getPathname(), null, $readerType)->chain([
                    new \App\Jobs\NotifyUserOfCompletedImport($user->email, "Lớp Học Phần")
                ]);
                break;
            default:
                return response()->error("Yêu cầu không hợp lệ!");
        }
        return response()->success([], "Quá trình Import dữ liệu đã bắt đầu. Bạn sẽ được thông báo khi hoàn tất!");
    }
}
