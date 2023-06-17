<?php

namespace App\Http\Livewire;

use App\Exceptions\InvalidClassException;
use App\Services\Student\StudentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class StudentListTable extends Component
{
    use WithPagination;
    public string $unique_id;
    public string $search = '';
    public int $per_page = 10;
    private StudentService $studentService;

    public function mount(StudentService $studentService, $unique_id = null, $per_page = 10)
    {
        $this->studentService = $studentService;
        $this->unique_id = $unique_id ?? Str::random(10);
        $this->per_page = $per_page;
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

        $students = $this->studentService->getStudentsOfTeacher($this->search);
        $students = $students->paginate(10);
        return view('livewire.student-list-table', [
            'students' => $students,
        ]);
    }
}
