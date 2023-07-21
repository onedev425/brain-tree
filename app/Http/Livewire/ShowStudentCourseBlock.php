<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowStudentCourseBlock extends Component
{
    public int $course_id;
    public string $title;
    public string $image;
    public string $created_at;
    public int $lesson_nums;
    public int $quiz_nums;
    public int $progress;
    public $rate;
    public int $feedback_nums;

    public function render()
    {
        return view('livewire.show-student-course-block');
    }
}
