<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Industry;


class TeacherCourseCreateForm extends Component
{
    public $industries;

    public function mount()
    {
        $this->industries = Industry::orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.teacher-course-create-form');
    }
}
