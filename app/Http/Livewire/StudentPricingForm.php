<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentPricingForm extends Component
{
    public $activeTab = 'buy_course';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.student-pricing-form');
    }
}
