<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Models\Industry;
use App\Models\Language;
use Livewire\Component;

class TeacherProfileForm extends Component
{
    public $state = [];
    public $countries;
    public $languages;
    public $industries;

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
        $this->countries = Country::orderBy('name')->get();
        $this->languages = Language::orderBy('name')->get();
        $this->industries = Industry::orderBy('name')->get();
    }

    public function render()
    {
        return view('profile.teacher-profile-form');
    }
}
