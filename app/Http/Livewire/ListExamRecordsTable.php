<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Models\ExamRecord;
use App\Models\Subject;
use App\Models\User;
use App\Services\Exam\ExamService;
use App\Services\Subject\SubjectService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ListExamRecordsTable extends Component
{
    use WithPagination;

    protected $queryString = ['examSelectedId'];

    public Collection $exams;

    public $examSlots;

    public $exam;

    public $subjects;

    public $subject;

    public $examRecords;

    public $subjectSelected;

    public $examSelected;

    public $error;

    public $examSelectedId;

    public $subjectSelectedId;

    public function mount(ExamService $examService)
    {
    }

    public function fetchExamRecords(Exam $exam, Subject $subject)
    {
    }

    public function render()
    {
        return view('livewire.list-exam-records-table', $viewData);
    }
}
