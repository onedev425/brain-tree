<?php

namespace App\Http\Livewire;

use App\Services\Teacher\TeacherService;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class MarksTable extends Component
{
    use WithPagination;
    public string $unique_id;
    public string $search = '';
    public int $per_page = 10;
    private TeacherService $teacherService;

    public function mount(TeacherService $teacherService, $unique_id = null, $per_page = 10)
    {
        $this->teacherService = $teacherService;
        $this->unique_id = $unique_id ?? Str::random(10);
        $this->per_page = $per_page;
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
        $students = $this->teacherService->getStudentMarksOfTeacher($this->search);
        $students = $students->paginate(10);

        return view('livewire.marks-table', [
            'students' => $students,
        ]);
    }
}
