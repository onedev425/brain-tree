<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowStudentCourseForm extends Component
{
    public $activeQuiz = [];

    public function setQuiz($quiz_id)
    {
        if (in_array($quiz_id, $this->activeQuiz))
            $this->activeQuiz = array_diff($this->activeQuiz, array($quiz_id));
        else
            $this->activeQuiz[] = $quiz_id;
    }

    public function render()
    {
        return view('livewire.show-student-course-form');
    }
}
