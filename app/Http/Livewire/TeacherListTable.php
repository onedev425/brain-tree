<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
class TeacherListTable extends Component
{
    use WithPagination;
    public string $unique_id;
    public string $search = '';
    public int $per_page = 10;

    private TeacherService $teacherService;

    public function mount($unique_id = null, $per_page = 10)
    {
        $this->unique_id = $unique_id ?? Str::random(10);
        $this->per_page = $per_page;
    }

    public function paginationView()
    {
        return 'components.datatable-pagination-links-view';
    }

    public function render()
    {
        $teachers = User::Role('teacher');
        $teachers = $teachers->paginate(10);
        return view('livewire.teacher-list-table', [
            'teachers' => $teachers,
        ]);
    }
}
