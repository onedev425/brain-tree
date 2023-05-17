<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use Livewire\Component;

class EditExamForm extends Component
{
    public Exam $exam;

    public function render()
    {
        return view('livewire.edit-exam-form');
    }
}
