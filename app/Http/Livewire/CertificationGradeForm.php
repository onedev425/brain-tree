<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class CertificationGradeForm extends Component
{
    public string $activeTab = 'certification';
    public Collection $completed_courses;

    public function mount(CourseService $courseService): void
    {
        $this->activeTab = (Request::has('type') && Request::filled('type')) ? Request::input('type') : 'certification';
        $this->completed_courses = $courseService->getCourses('completed');
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.certification-grade-form');
    }

    public function getCourseTotalPoints(Course $course): int
    {
        return $course->questions->sum('points');
    }

    public function getPointsOfStudentExam(Course $course): int
    {
        $studentService = app(StudentService::class);
        return $studentService->getPointsOfStudentExam($course->id, auth()->user()->id);
    }

    public function getCourseCompletedDate(Course $course): string
    {
        $studentService = app(StudentService::class);
        return $studentService->getCourseCompletedDate($course);
    }

    public function getCourseStartedDate(Course $course): string
    {
        $studentService = app(StudentService::class);
        return $studentService->getCourseStartedDate($course);
    }
}
