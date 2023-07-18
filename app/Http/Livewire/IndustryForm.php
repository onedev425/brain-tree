<?php

namespace App\Http\Livewire;

use App\Models\Industry;
use Livewire\Component;

class IndustryForm extends Component
{
    public array $state = [];
    public Industry $industry;

    public function mount()
    {
        $this->state['industry_name'] = $this->industry->name;
    }

    public function render()
    {
        return view('livewire.industry-form');
    }
}
