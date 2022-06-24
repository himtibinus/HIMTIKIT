<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        session_start();
        if ($request->session()->get('isAdmin') == true) {
            return redirect('/admin');
        } else if ($request->session()->get('Name')) {
            $request->session()->put('activemenu', 'Course');
            $MajorList = DB::select("select * from ltmajor");
            $SmtList = DB::select("SELECT DISTINCT ls.SmtID, ls.SmtName from ltsmt AS ls RIGHT JOIN msmajorcourse AS mjc ON ls.SmtID = mjc.SmtID WHERE mjc.MajorID = " . $MajorList[0]->MajorID);
            $MajorCourseList = DB::select("SELECT mjc.CourseID, CourseName, CourseDescription, CourseImage, `FileName`, SmtID FROM msmajorcourse AS mjc JOIN ltcourse as lc ON lc.CourseID = mjc.CourseID WHERE MajorID = " . $MajorList[0]->MajorID . " ORDER BY SmtID ASC");

            if ($request->session()->get('Major')) {
                $Major = $request->session()->get('Major');

                $SmtList = DB::select("SELECT DISTINCT ls.SmtID, ls.SmtName from ltsmt AS ls RIGHT JOIN msmajorcourse AS mjc ON ls.SmtID = mjc.SmtID WHERE mjc.MajorID = " . $Major);
                $MajorCourseList = DB::select("SELECT mjc.CourseID, CourseName, CourseDescription, CourseImage, `FileName`, SmtID FROM msmajorcourse AS mjc JOIN ltcourse as lc ON lc.CourseID = mjc.CourseID WHERE MajorID = " . $Major . " ORDER BY SmtID ASC");
            }

            return view('index', ['MajorList' => $MajorList, 'SmtList' => $SmtList, 'MajorCourseList' => $MajorCourseList]);
        } else {
            return redirect('/login');
        }
    }

    public function changeMajor(Request $request)
    {
        session_start();
        if ($request->session()->get('Name')) {
            $request->validate([
                'major' => 'required'
            ]);
            $request->session()->put('Major', $request->major);

            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    public function software(Request $request)
    {
        session_start();
        if ($request->session()->get('Name')) {
            $request->session()->put('activemenu', 'Software');
            return view('software');
        } else {
            return redirect('/login');
        }
    }

    public function DownloadMaterial(Request $request, $CourseID)
    {
        session_start();
        if (!$request->session()->get('Name')) {
            return redirect('/login');
        }

        $MajorList = DB::select("select * from ltmajor");
        $MajorCourseList = DB::select("SELECT mjc.CourseID, CourseName, CourseDescription, SmtID FROM msmajorcourse AS mjc JOIN ltcourse as lc ON lc.CourseID = mjc.CourseID WHERE MajorID = " . $MajorList[0]->MajorID . " ORDER BY SmtID ASC");

        $isExist = array_search($CourseID, array_column($MajorCourseList, "CourseID"));

        if (false !== $isExist) {
            $course = DB::Table('ltcourse')->where('CourseID', $CourseID)->first();
            return response()->download(storage_path('app/' . $course->FileName));
        } else {
            return abort('404');
        }
    }
}