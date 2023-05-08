<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class GraduateStudents extends Component
{
    public $students;

    public function mount()
    {
    }

    public function loadStudents()
    {
        $this->validate();

        $this->students;
    }

    public function render()
    {
        return view('livewire.graduate-students');
    }
}
