<?php

namespace App\Http\Livewire;

use App\Services\Course\CourseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Illuminate\Support\Facades\Request;

class TeacherCourseMainForm extends Component
{
    public string $activeTab = 'publish';
    public Collection $publish_courses;
    public Collection $draft_courses;

    public function mount(CourseService $courseService): void
    {
        $this->activeTab = (Request::has('type') && Request::filled('type')) ? Request::input('type') : 'publish';
        $this->publish_courses = $courseService->getCourses('publish');
        $this->draft_courses = $courseService->getCourses('draft');
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.teacher-course-main-form');
    }
}
