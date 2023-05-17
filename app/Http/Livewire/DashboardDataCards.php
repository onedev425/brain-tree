<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DashboardDataCards extends Component
{
    public $students;

    public $teachers;

    public function mount()
    {
        $this->students = User::students()->activeStudents()->count();
        $this->teachers = User::role('teacher')->count();
    }

    public function render()
    {
        return view('livewire.dashboard-data-cards');
    }
}
