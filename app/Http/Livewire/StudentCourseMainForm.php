<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Services\Course\CourseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class StudentCourseMainForm extends Component
{
    public string $activeTab = 'progress';
    public Collection $progress_courses;
    public Collection $completed_courses;
    private CourseService $courseService;

    public function mount(CourseService $courseService): void
    {
        $this->progress_courses = $courseService->getCourses('progress');
        $this->completed_courses = $courseService->getCourses('completed');
        $this->courseService = $courseService;
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.student-course-main-form');
    }
}
