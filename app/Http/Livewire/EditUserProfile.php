<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Country;
use App\Models\Industry;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class EditUserProfile extends Component
{
    public User $user;
    public Collection $countries;
    public Collection $languages;
    public Collection $industries;
    public int $user_country_id;
    public int $user_language_id;
    public int $user_industry_id;

    public string $user_country_iso2;
    public string $user_experience;

    public function mount()
    {
        $this->countries = Country::orderBy('name')->get();
        $this->languages = Language::orderBy('name')->get();
        $this->industries = Industry::orderBy('name')->get();

        if (is_null($this->user->country_id)) {
            $usa_country = Country::where('iso2', 'US')->first();
            $this->user_country_id = $usa_country->id;
            $this->user_country_iso2 = $usa_country->iso2;
        }
        else {
            $this->user_country_id = $this->user->country_id;
            $selected_country = Country::find($this->user_country_id);
            $this->user_country_iso2 = $selected_country->iso2;
        }

        if (is_null($this->user->language_id)) {
            $en_language = Language::where('code', 'en')->first();
            $this->user_language_id = $en_language ? $en_language->id : 0;
        }
        else $this->user_language_id = $this->user->language_id;

        if (is_null($this->user->industry_id)) {
            $first_industry = Industry::all()->first();
            $this->user_industry_id = $first_industry ? $first_industry->id : 0;
        }
        else $this->user_industry_id = $this->user->industry_id;

        $this->user_experience = $this->user->experience ?? '1';
    }

    public function render()
    {
        return view('livewire.edit-user-profile');
    }
}
