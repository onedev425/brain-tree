<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Industry;
use App\Models\Language;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfileForm extends Component
{
    public $state = [];
    public $countries;
    public $languages;
    public $industries;
    public $default_country = '';
    public $default_language = '';

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
        $this->countries = Country::orderBy('name')->get();
        $this->languages = Language::orderBy('name')->get();
        $this->industries = Industry::orderBy('name')->get();

        $usa_country = Country::where('iso2', 'US')->first();
        $this->default_country = $usa_country ? $usa_country->id : 0;
        $eng_language = Language::where('code', 'en')->first();
        $this->default_language = $eng_language ? $eng_language->id : 0;
    }

    public function setDefaultCountry()
    {
        if (!$this->state['country_id']) {
            $this->state['country_id'] = $this->default_country;
        }
    }

    public function setDefaultLanguage()
    {
        if (!$this->state['language_id']) {
            $this->state['language_id'] = $this->default_language;
        }
    }

    public function render()
    {
        return view('profile.profile-form');
    }
}
