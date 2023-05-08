<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ResultChecker extends Component
{
    public $students;

    public $student;

    public $exams;

    public $examRecords;

    public $subjects;

    public $preparedResults;

    public $status;

    public $studentName;

    public function checkResult(User $student)
    {
    }

    public function render()
    {
        return view('livewire.result-checker');
    }
}
