<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Models\Industry;


class TeacherCourseCreateForm extends Component
{
    public array $state = [];
    public Collection $industries;
    public Course $course;
    public Collection $topics;
    public Collection $quizzes;

    public function mount()
    {
        $this->state['course_title'] = $this->course->title;
        $this->state['industry_id'] = $this->course->industry_id;
        $this->state['price'] = $this->course->price;
        $this->state['pass_percent'] = $this->course->pass_percent;
        $this->state['course_description'] = $this->course->description;
        $this->industries = Industry::orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.teacher-course-create-form');
    }
}
