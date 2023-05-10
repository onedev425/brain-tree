<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TeacherCourseMainForm extends Component
{
    public $activeTab = 'publish';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.teacher-course-main-form');
    }
}
