<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Services\Exam\ExamService;
use App\Traits\MarkTabulationTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class ExamTabulation extends Component
{
    use MarkTabulationTrait;

    public $exam;

    public $title;

    public $exams;

    public $tabulatedRecords;

    public $grades;

    public $error;

    public $createdTabulation;

    protected $listeners = ['print'];

    public function mount(ExamService $examService)
    {
        $this->exams;

        //set exam as first exam if exams not empty
        $this->exams->count() ? $this->exam = $this->exams[0]->id : $this->exam = null;
    }

    public function tabulate(Exam $exam)
    {
        $this->createdTabulation = true;
    }

    //print function

    public function print()
    {
        //used pdf class directly
        $pdf = Pdf::loadView('pages.exam.print-exam-tabulation', ['tabulatedRecords' => $this->tabulatedRecords, 'totalMarksAttainableInEachSubject' => $this->totalMarksAttainableInEachSubject, 'subjects' => $this->subjects])->output();
        //save as pdf
        return response()->streamDownload(
            fn () => print($pdf),
            'exam-tabiulation.pdf'
        );
    }

    public function render()
    {
        return view('livewire.exam-tabulation');
    }
}
