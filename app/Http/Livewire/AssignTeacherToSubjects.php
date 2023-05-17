<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Services\Teacher\TeacherService;
use Livewire\Component;

class AssignTeacherToSubjects extends Component
{
    public $teachers;

    public $subjects;

    public $teacher;

    /**
     * State variable for teacher.
     */
    public User $teacherState;

    public function mount(TeacherService $teacherService)
    {
        $this->teachers = $teacherService->getAllTeachers();
        $this->teacher = $this->teachers->first()?->id;
    }

    public function fetchSubjects(User $teacher)
    {
        $this->teacherState = $teacher;
    }

    public function render()
    {
        return view('livewire.assign-teacher-to-subjects');
    }
}
