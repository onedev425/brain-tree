<?php

namespace App\Http\Livewire;

use App\Exceptions\InvalidClassException;
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
        $students = DB::table('users as U')
            ->select('U.id', 'U.name', 'U.created_at', 'U.profile_photo_path')
            ->joinSub(function ($query) {
                $query->select('C.id', 'SL.student_id AS lesson_student_id', 'SQ.student_id AS question_student_id')
                    ->from('courses as C')
                    ->leftJoin('student_lessons as SL', 'C.id', '=', 'SL.course_id')
                    ->leftJoin('student_questions as SQ', 'C.id', '=', 'SQ.course_id')
                    ->where('C.assigned_id', 30);
            }, 'C', function ($join) {
                $join->on('U.id', '=', 'C.lesson_student_id')
                    ->orOn('U.id', '=', 'C.question_student_id');
            });
        if ($this->search != '')
            $students = $students->where('U.name', 'LIKE', '%'. $this->search . '%');
        $students = $students->groupBy('U.id', 'U.name', 'U.created_at', 'U.profile_photo_path');

        //$users = DB::table('users as U')->where('U.name', $this->search);
        $students = $students->paginate(10);
        return view('livewire.student-list-table', [
            'students' => $students,
        ]);
    }
}
