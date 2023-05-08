<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Models\ExamRecord;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use App\Services\Exam\ExamService;
use App\Services\MyClass\MyClassService;
use App\Services\Section\SectionService;
use App\Services\Subject\SubjectService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ListExamRecordsTable extends Component
{
    use WithPagination;

    protected $queryString = ['sectionSelectedId', 'examSelectedId', 'subjectSelectedId'];

    public Collection $exams;

    public $examSlots;

    public $exam;

    public $classes;

    public $class;

    public $subjects;

    public $subject;

    public $sections;

    public $section;

    public $examRecords;

    public $classSelected;

    public $subjectSelected;

    public $sectionSelected;

    public $examSelected;

    public $error;

    public $sectionSelectedId;

    public $examSelectedId;

    public $subjectSelectedId;

    public function mount(ExamService $examService)
    {
    }

    public function updatedClass()
    {
    }

    public function fetchExamRecords(Exam $exam, Section $section, Subject $subject)
    {
    }

    public function render()
    {
        return view('livewire.list-exam-records-table', $viewData);
    }
}
