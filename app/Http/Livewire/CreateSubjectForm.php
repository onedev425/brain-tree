<?php

namespace App\Http\Livewire;

use App\Services\Teacher\TeacherService;
use Livewire\Component;

class CreateSubjectForm extends Component
{
    public $teachers;

    public function mount(TeacherService $teacherService)
    {
        $this->teachers = $teacherService->getAllTeachers();
    }

    public function render()
    {
        return view('livewire.create-subject-form');
    }
}
