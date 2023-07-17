<?php

namespace App\Http\Controllers;

use App\Services\Student\StudentService;
use Illuminate\Http\Request;
use App\Models\Course;
use PDF;
class CertificationController extends Controller
{
    public function index()
    {
        return view('pages.certification.index');
    }

    public function download(Request $request)
    {
        $course_info = explode('&', base64_decode(urldecode($request['id'])));
        $course_id = $course_info[1];

        $course = Course::find($course_id);
        $studentService = app(StudentService::class);

        $data['name'] = auth()->user()->name;
        $data['course_title'] = $course->title;
        $data['course_started_date'] = date('m-d-Y', strtotime($studentService->getCourseStartedDate($course)));
        $data['course_completed_date'] = date('m-d-Y', strtotime($studentService->getCourseCompletedDate($course)));

        // return view('pdf.certification', $data);
        $pdf = PDF::loadView('pdf.certification', $data);
        $pdf->setPaper([0, 0, 1685, 1191]);
        return $pdf->download('certification.pdf');
    }
}
