<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\User;
use App\Services\Course\CourseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowTeacherProfile extends Component
{
    public User $teacher;
    public string $activeTab = 'publish';
    public Collection $publish_courses;
    public Collection $draft_courses;

    public function mount(CourseService $courseService): void
    {
        $this->publish_courses = $courseService->getCourses('publish', $this->teacher);
        $this->draft_courses = $courseService->getCourses('draft', $this->teacher);
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.show-teacher-profile');
    }

    public function getCourseVideoDuration(Course $course): string
    {
        $courseService = new CourseService();
        return $courseService->getCourseVideoDuration($course);
    }
}
