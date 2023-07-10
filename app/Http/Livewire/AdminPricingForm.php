<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Livewire\Component;

class AdminPricingForm extends Component
{
    public $activeTab = 'purchase_histories';

    public function mount(): void
    {
        $this->activeTab = (Request::has('type') && Request::filled('type')) ? Request::input('type') : 'purchase_histories';
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function render(): View
    {
        return view('livewire.admin-pricing-form');
    }
}
