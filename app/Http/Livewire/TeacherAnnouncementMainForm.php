<?php

namespace App\Http\Livewire;
use App\Models\Announcement;

use Livewire\Component;

class TeacherAnnouncementMainForm extends Component
{
    public $announcements;
    public $courses;

    public function mount($announcements, $courses)
    {
        $this->announcements = $announcements; // Assign the passed announcement
        $this->courses = $courses;
    }
    public function render()
    {
        return view('livewire.teacher-announcement-main-form');
    }
}
