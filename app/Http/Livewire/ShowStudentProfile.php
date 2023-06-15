<?php

namespace App\Http\Livewire;

use App\Models\StudentRecord;
use App\Models\User;
use App\Services\Student\StudentService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowStudentProfile extends Component
{
    public User $student;

    public StudentRecord $studentRecord;

    public string $activeTab = 'progress';
    public Collection $progress_courses;
    public Collection $completed_courses;

    public function mount(StudentService $studentService)
    {
        $this->student = $this->student->loadMissing('studentRecord');
        $this->studentRecord = $this->student->studentRecord()->withoutGlobalScopes()->first();

        $this->progress_courses = $studentService->getCourses($this->student, 'progress');
        $this->completed_courses = $studentService->getCourses($this->student, 'completed');
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
//        $progress_courses = [];
//        $course = new \stdClass();
//        $course->title = 'Learning Laravel Framework';
//        $course->created_at = 'May 20, 2023 4:32 am';
//        $course->image = asset('upload/course/course-1.jpg');
//        $course->lesson_nums = 10;
//        $course->quiz_nums = 5;
//        $course->progress = 50;
//        $course->mark = '86 / 100';
//        $progress_courses[] = $course;
//
//        $course = new \stdClass();
//        $course->title = 'Learning MySQL Framework';
//        $course->created_at = 'May 20, 2021 4:32 am';
//        $course->image = asset('upload/course/course-2.jpg');
//        $course->lesson_nums = 15;
//        $course->quiz_nums = 12;
//        $course->progress = 90;
//        $course->mark = '71 / 100';
//        $progress_courses[] = $course;
//
//        $course = new \stdClass();
//        $course->title = 'Wordpress Blogging, Tumblr And Blogger';
//        $course->created_at = 'March 20, 2021 4:32 am';
//        $course->image = asset('upload/course/course-3.jpg');
//        $course->lesson_nums = 10;
//        $course->quiz_nums = 10;
//        $course->progress = 30;
//        $course->mark = '69 / 100';
//        $progress_courses[] = $course;
//
//        $course = new \stdClass();
//        $course->title = 'Learn Web Design & Development';
//        $course->created_at = 'Oct 20, 2021 4:32 am';
//        $course->image = asset('upload/course/course-4.jpg');
//        $course->lesson_nums = 5;
//        $course->quiz_nums = 2;
//        $course->progress = 0;
//        $course->mark = '85 / 100';
//        $progress_courses[] = $course;
//
//        $course = new \stdClass();
//        $course->title = 'Learning Laravel and Livewire';
//        $course->created_at = 'May 20, 2021 4:32 am';
//        $course->image = asset('upload/course/course-5.jpg');
//        $course->lesson_nums = 8;
//        $course->quiz_nums = 15;
//        $course->progress = 75;
//        $course->mark = '53 / 100';
//        $progress_courses[] = $course;
//
//        $course = new \stdClass();
//        $course->title = 'Tailwnd CSS Documentation';
//        $course->created_at = 'May 20, 2021 4:32 am';
//        $course->image = asset('upload/course/course-6.jpg');
//        $course->lesson_nums = 11;
//        $course->quiz_nums = 11;
//        $course->progress = 95;
//        $course->mark = '12 / 100';
//        $progress_courses[] = $course;
//
//
//        $completed_courses = [];
//        $course = new \stdClass();
//        $course->title = 'AWS and Heroku';
//        $course->created_at = 'May 20, 2021 4:32 am';
//        $course->image = asset('upload/course/course-7.png');
//        $course->lesson_nums = 10;
//        $course->quiz_nums = 1;
//        $course->progress = 100;
//        $course->mark = '90 / 100';
//        $completed_courses[] = $course;
//
//
//        $data['progress_courses'] = $progress_courses;
//        $data['completed_courses'] = $completed_courses;

//        return view('livewire.show-student-profile', $data);
        return view('livewire.show-student-profile');
    }
}
