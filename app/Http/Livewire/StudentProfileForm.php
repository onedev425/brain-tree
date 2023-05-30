<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;

class StudentProfileForm extends Component
{
    public $state = [];
    public $countries;
    public $languages;

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
        $this->countries = Country::all();
    }

    public function render()
    {
        return view('profile.student-profile-form');
    }
}
