<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class TeacherCourseBlock extends Component
{
    public int $course_id;
    public string $title;
    public string $image;
    public string $created_at;
    public string $duration;
    public string $price;
    public int $is_published;

    public function render(): View
    {
        return view('livewire.teacher-course-block');
    }
}
