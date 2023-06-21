<?php

namespace App\Http\Livewire;

use App\Services\Student\StudentService;
use Livewire\Component;
use Livewire\WithPagination;

class StudentPricingBuyCourse extends Component
{
    use WithPagination;

    public string $search = '';
    private StudentService $studentService;

    public function mount(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    public function paginationView()
    {
        return 'components.datatable-pagination-links-view';
    }

    public function render()
    {

//        $excludedCourseIds = StudentCourse::where('student_id', 31)->pluck('course_id');
//        $courses = Course::whereNotIn('id', $excludedCourseIds)->with('assignedTeacher');
//        $courses = $courses->paginate(10);

        if (!isset($this->studentService)) {
            $this->studentService = app(StudentService::class);
        }

        $courses = $this->studentService->getStudentUnpaidCourses($this->search);
        $courses = $courses->paginate(10);

        return view('livewire.student-pricing-buy-course', [
            'courses' => $courses,
        ]);
    }
}
