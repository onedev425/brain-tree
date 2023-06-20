<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Request;

class PricingForm extends Component
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
        return view('livewire.pricing-form');
    }
}
