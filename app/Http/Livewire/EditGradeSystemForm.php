<?php

namespace App\Http\Livewire;

use App\Models\GradeSystem;
use Livewire\Component;

class EditGradeSystemForm extends Component
{
    public GradeSystem $grade;

    public function render()
    {
        return view('livewire.edit-grade-system-form');
    }
}
