<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Request;
use Livewire\Component;

class TeacherPricingForm extends Component
{
    public $activeTab = 'histories';

    public function mount(): void
    {
        $this->activeTab = (Request::has('type') && Request::filled('type')) ? Request::input('type') : 'histories';
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.teacher-pricing-form');
    }
}
