<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TeacherCourseBlock extends Component
{
    public string $title;
    public string $image;
    public string $created_at;
    public string $lessons;
    public string $price;

    public function render()
    {
        return view('livewire.teacher-course-block');
    }
}
