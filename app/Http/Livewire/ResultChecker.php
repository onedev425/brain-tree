<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Services\MyClass\MyClassService;
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

    public function mount(MyClassService $myClassService)
    {
        if (auth()->user()->hasAnyRole(['super-admin', 'admin', 'teacher'])) {
            $this->classes = $myClassService->getAllClasses();

            if ($this->classes->isEmpty()) {
                return;
            }
            $this->class = $this->classes[0]->id;
            $this->updatedClass();
        } 
    }

    public function updatedClass()
    {
        //get instance of class
        $class = app("App\Services\MyClass\MyClassService")->getClassById($this->class);

        //get sections in class
        $this->sections = $class->sections;

        //set section if the fetched records aren't empty
        if ($this->sections->isEmpty()) {
            $this->students = null;

            return;
        }
        $this->section = $this->sections[0]->id;

        $this->updatedSection();
    }

    public function updatedSection()
    {
        //get instance of section
        $section = app("App\Services\Section\SectionService")->getSectionById($this->section);

        //get students in section
        $this->students = $section->students();

        //set student if the fetched records aren't empty
        $this->students->count() ? $this->student = $this->students[0]->id : $this->student = null;
    }

    public function checkResult(User $student)
    {
    }

    public function render()
    {
        return view('livewire.result-checker');
    }
}
