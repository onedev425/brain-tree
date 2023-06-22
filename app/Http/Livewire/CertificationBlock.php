<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CertificationBlock extends Component
{
    public int $course_id;
    public string $course_title;
    public string $teacher;
    public int $marks;
    public int $course_points;
    public string $completed_date;
    public string $started_date;

    public function render()
    {
        return view('livewire.certification-block');
    }
}
