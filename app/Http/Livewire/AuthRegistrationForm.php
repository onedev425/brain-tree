<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Industry;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class AuthRegistrationForm extends Component
{
    public Collection $countries;
    public Collection $languages;
    public Collection $industries;

    public int $default_country_id;
    public int $default_language_id;
    public int $default_industry_id;

    public function mount()
    {
        $this->countries = Country::orderBy('name')->get();
        $this->languages = Language::orderBy('name')->get();
        $this->industries = Industry::orderBy('name')->get();

        $usa_country = Country::where('iso2', 'US')->first();
        $this->default_country_id = $usa_country->id;

        $en_language = Language::where('code', 'en')->first();
        $this->default_language_id = $en_language ? $en_language->id : 0;

        $first_industry = Industry::all()->first();
        $this->default_industry_id = $first_industry ? $first_industry->id : 0;
    }

    public function render()
    {
        return view('livewire.auth-registration-form');
    }
}
