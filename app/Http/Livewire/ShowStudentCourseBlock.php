<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowStudentCourseBlock extends Component
{
    public $title;
    public $image;
    public $created_at;
    public $lesson_nums;
    public $quiz_nums;
    public $progress;

    public function render()
    {
        return view('livewire.show-student-course-block');
    }
}
