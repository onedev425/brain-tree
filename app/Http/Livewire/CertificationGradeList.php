<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\User;
use App\Services\Student\StudentService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CertificationGradeList extends Component
{
    public User $student;
    private StudentService $studentService;
    public Collection $all_courses;

    public function mount(StudentService $studentService)
    {
        $this->student = auth()->user();
        $this->studentService = $studentService;
        $this->all_courses = $this->studentService->getCourses($this->student, 'all');
    }

    public function render()
    {
        return view('livewire.certification-grade-list');
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
