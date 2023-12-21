<?php

namespace App\Http\Livewire;

use App\Services\Teacher\TeacherService;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherPricingHistories extends Component
{
    use WithPagination;

    public string $search = '';
    public string $fromDate = '';
    public string $toDate = '';
    private TeacherService $teacherService;


    public function mount(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function paginationView()
    {
        return 'components.datatable-pagination-links-view';
    }

    public function render()
    {
        if (!isset($this->teacherService)) {
            $this->teacherService = app(TeacherService::class);
        }

        $courses = $this->teacherService->getSoldCourses($this->search, $this->fromDate, $this->toDate);
        $courses = $courses->paginate(10);

        return view('livewire.teacher-pricing-histories', [
            'courses' => $courses,
        ]);
    }
}
