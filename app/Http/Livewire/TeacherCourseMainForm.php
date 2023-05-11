<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TeacherCourseMainForm extends Component
{
    public $activeTab = 'publish';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $publish_courses = [];
        $course = new \stdClass();
        $course->title = 'Learning Laravel Framework';
        $course->created_at = 'May 20, 2023 4:32 am';
        $course->duration = '22h 30m';
        $course->image = asset('upload/course/course-1.jpg');
        $course->price = 120;
        $publish_courses[] = $course;

        $course = new \stdClass();
        $course->title = 'Learning MySQL Framework';
        $course->created_at = 'May 20, 2021 4:32 am';
        $course->duration = '12h 30m';
        $course->image = asset('upload/course/course-2.jpg');
        $course->price = 320;
        $publish_courses[] = $course;

        $course = new \stdClass();
        $course->title = 'Wordpress Blogging, Tumblr And Blogger';
        $course->created_at = 'March 20, 2021 4:32 am';
        $course->duration = '12h 30m';
        $course->image = asset('upload/course/course-3.jpg');
        $course->price = 220;
        $publish_courses[] = $course;

        $course = new \stdClass();
        $course->title = 'Learn Web Design & Development';
        $course->created_at = 'Oct 20, 2021 4:32 am';
        $course->duration = '12h 30m';
        $course->image = asset('upload/course/course-4.jpg');
        $course->price = 90;
        $publish_courses[] = $course;

        $course = new \stdClass();
        $course->title = 'Learning Laravel and Livewire';
        $course->created_at = 'May 20, 2021 4:32 am';
        $course->duration = '12h 30m';
        $course->image = asset('upload/course/course-5.jpg');
        $course->price = 230;
        $publish_courses[] = $course;

        $course = new \stdClass();
        $course->title = 'Tailwnd CSS Documentation';
        $course->created_at = 'May 20, 2021 4:32 am';
        $course->duration = '12h 30m';
        $course->image = asset('upload/course/course-6.jpg');
        $course->price = 140;
        $publish_courses[] = $course;



        $data['publish_courses'] = $publish_courses;
        return view('livewire.teacher-course-main-form', $data);
    }
}
