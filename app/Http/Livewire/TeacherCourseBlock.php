<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TeacherCourseBlock extends Component
{
    public $title;
    public $image;
    public $created_at;
    public $duration;
    public $price;

    public function render()
    {
        return view('livewire.teacher-course-block');
    }
}
