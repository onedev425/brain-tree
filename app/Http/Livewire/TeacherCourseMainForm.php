<?php

namespace App\Http\Livewire;

use App\Services\Course\CourseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Course;

class TeacherCourseMainForm extends Component
{
    public string $activeTab = 'publish';
    public Collection $publish_courses;
    public Collection $draft_courses;
    private CourseService $courseService;

    public function mount(CourseService $courseService): void
    {
        $this->activeTab = (Request::has('type') && Request::filled('type')) ? Request::input('type') : 'publish';
        $this->publish_courses = $courseService->getCourses('publish');
        $this->draft_courses = $courseService->getCourses('draft');
        $this->courseService = $courseService;
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function render(): View
    {
        return view('livewire.teacher-course-main-form');
    }

    public function getCourseVideoDuration(Course $course): string
    {
        return $this->courseService->getCourseVideoDuration($course);
    }
}
