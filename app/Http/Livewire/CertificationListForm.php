<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\User;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CertificationListForm extends Component
{
    public Collection $completed_courses;

    public function mount(CourseService $courseService): void
    {
        $this->completed_courses = $courseService->getCourses('completed');
    }

    public function render()
    {
        return view('livewire.certification-list-form');
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
}
