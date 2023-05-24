<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentCourseMainForm extends Component
{
    public $activeTab = 'progress';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $progress_courses = [];
        $course = new \stdClass();
        $course->id = 1;
        $course->title = 'Learning Laravel Framework';
        $course->created_by = 'Bobby Mark Fest';
        $course->image = asset('upload/course/course-1.jpg');
        $course->lesson_nums = 10;
        $course->quiz_nums = 5;
        $course->progress = 50;
        $course->mark = '86 / 100';
        $progress_courses[] = $course;

        $course = new \stdClass();
        $course->id = 2;
        $course->title = 'Learning MySQL Framework';
        $course->created_by = 'Rocksuly Chan';
        $course->image = asset('upload/course/course-2.jpg');
        $course->lesson_nums = 15;
        $course->quiz_nums = 12;
        $course->progress = 90;
        $course->mark = '71 / 100';
        $progress_courses[] = $course;

        $course = new \stdClass();
        $course->id = 3;
        $course->title = 'Wordpress Blogging, Tumblr And Blogger';
        $course->created_by = 'Bobby';
        $course->image = asset('upload/course/course-3.jpg');
        $course->lesson_nums = 10;
        $course->quiz_nums = 10;
        $course->progress = 30;
        $course->mark = '69 / 100';
        $progress_courses[] = $course;

        $course = new \stdClass();
        $course->id = 4;
        $course->title = 'Learn Web Design & Development';
        $course->created_by = 'Lionel Messi';
        $course->image = asset('upload/course/course-4.jpg');
        $course->lesson_nums = 5;
        $course->quiz_nums = 2;
        $course->progress = 0;
        $course->mark = '85 / 100';
        $progress_courses[] = $course;

        $course = new \stdClass();
        $course->id = 5;
        $course->title = 'Learning Laravel and Livewire';
        $course->created_by = 'Ronaldo';
        $course->image = asset('upload/course/course-5.jpg');
        $course->lesson_nums = 8;
        $course->quiz_nums = 15;
        $course->progress = 75;
        $course->mark = '53 / 100';
        $progress_courses[] = $course;

        $course = new \stdClass();
        $course->id = 6;
        $course->title = 'Tailwnd CSS Documentation';
        $course->created_by = 'Ziddan';
        $course->image = asset('upload/course/course-6.jpg');
        $course->lesson_nums = 11;
        $course->quiz_nums = 11;
        $course->progress = 95;
        $course->mark = '12 / 100';
        $progress_courses[] = $course;


        $completed_courses = [];
        $course = new \stdClass();
        $course->id = 7;
        $course->title = 'AWS and Heroku';
        $course->created_by = 'May 20, 2021 4:32 am';
        $course->image = asset('upload/course/course-7.png');
        $course->lesson_nums = 10;
        $course->quiz_nums = 1;
        $course->progress = 100;
        $course->mark = '90 / 100';
        $completed_courses[] = $course;


        $data['progress_courses'] = $progress_courses;
        $data['completed_courses'] = $completed_courses;
        return view('livewire.student-course-main-form', $data);
    }
}
