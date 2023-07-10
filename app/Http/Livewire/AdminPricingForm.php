<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Request;
use Livewire\Component;

class AdminPricingForm extends Component
{
    public $activeTab = 'purchase_histories';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.admin-pricing-form');
    }
}
