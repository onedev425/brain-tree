<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PricingForm extends Component
{
    public $activeTab = 'histories';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.pricing-form');
    }
}
