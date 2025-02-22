<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\User;
use App\Services\Student\StudentService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowStudentProfile extends Component
{
    public User $student;
    public Collection $progress_courses;
    public Collection $completed_courses;
    public Collection $all_courses;
    private StudentService $studentService;
    public string $activeTab = 'progress';

    public function mount(StudentService $studentService)
    {
        $this->studentService = $studentService;
        $this->progress_courses = $this->studentService->getCourses($this->student, 'progress');
        $this->completed_courses = $this->studentService->getCourses($this->student, 'completed');
        $this->all_courses = $this->studentService->getCourses($this->student, 'all');
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.show-student-profile');
    }

    public function getStudentCourseProgressPercent(Course $course, User $student): int
    {
        if (!isset($this->studentService)) {
            $this->studentService = app(StudentService::class);
        }
        return $this->studentService->getStudentCourseProgressPercent($course, $student);
    }

    public function getCourseTotalPoints(Course $course): int
    {
        return $course->questions->sum('points');
    }

    public function getPointsOfStudentExam(Course $course, User $student): int
    {
        return $this->studentService->getPointsOfStudentExam($course->id, $student->id);
    }
}
