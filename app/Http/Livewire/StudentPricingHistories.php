<?php

namespace App\Http\Livewire;

use App\Services\Student\StudentService;
use Livewire\Component;
use Livewire\WithPagination;

class StudentPricingHistories extends Component
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
        if (!isset($this->studentService)) {
            $this->studentService = app(StudentService::class);
        }

        $courses = $this->studentService->getStudentPaidCourses($this->search);
        $courses = $courses->paginate(10);

        return view('livewire.student-pricing-histories', [
            'courses' => $courses,
        ]);
    }
}
