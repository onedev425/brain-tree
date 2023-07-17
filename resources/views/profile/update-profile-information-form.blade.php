<x-partials.form-section submit="updateProfileInformation">
    <x-slot name="form">
        <x-action-message on="saved">
            {{ __('Updated Successfully.') }}
        </x-action-message>
        <div class="md:grid grid-cols-12 gap-4">
            @php
                $countries = App\Models\Country::orderBy('name')->get();
                $languages = App\Models\Language::orderBy('name')->get();
                $industries = App\Models\Industry::orderBy('name')->get();

                $usa_country = App\Models\Country::where('iso2', 'US')->first();
                $default_country = $usa_country ? $usa_country->id : 0;
                $eng_language = App\Models\Language::where('code', 'en')->first();
                $default_language = $eng_language ? $eng_language->id : 0;

                if ( !$this->state['country_id']) $this->state['country_id'] = $default_country;
                if ( !$this->state['language_id']) $this->state['language_id'] = $default_language;
            @endphp

            @if (auth()->user()->hasRole('student'))
                <x-input label="User Name" id="name" name="name" required="required" placeholder="Your Full Name" group-class="col-span-12" wire:model="state.name"/>
                <x-input label="Email" id="email" name="email" required="required" placeholder="Your Email Address" group-class="col-span-6" wire:model="state.email"/>
                <x-input label="Date of Birth" type="date" id="birthday" name="birthday" required="required" placeholder="Your birthday..." group-class="col-span-6" wire:model="state.birthday"/>
                <x-input label="Phone number" id="phone" name="phone" required="required" placeholder="Your phone number" group-class="col-span-6" wire:model="state.phone"/>

                <x-select label="Country" id="country" name="country" group-class="col-span-6" wire:model="state.country_id">
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </x-select>
                <x-select label="Industry" id="industry" name="industry" group-class="col-span-6" wire:model="state.industry_id">
                    @foreach ($industries as $industry)
                        <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                    @endforeach
                </x-select>

                <x-select label="Language" id="language" name="language" group-class="col-span-6" wire:model="state.language_id">
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}">{{ $language->name }} ({{ $language->name_native }})</option>
                    @endforeach
                </x-select>
            @else
                <x-input label="User Name" id="name" name="name" required="required" placeholder="Your Full Name" group-class="col-span-12" wire:model="state.name"/>
                <x-input label="Email" id="email" name="email" required="required" placeholder="Your Email Address" group-class="col-span-6" wire:model="state.email"/>
                <x-input label="Phone number" id="phone" name="phone" required="required" placeholder="Your phone number" group-class="col-span-6" wire:model="state.phone"/>

                <x-select label="Country" id="country" name="country" group-class="col-span-6" wire:model="state.country_id">
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </x-select>
                <x-select label="Industry" id="industry" name="industry" group-class="col-span-6" wire:model="state.industry_id">
                    @foreach ($industries as $industry)
                        <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                    @endforeach
                </x-select>

                <x-select label="Language" id="language" name="language" group-class="col-span-6" wire:model="state.language_id">
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}">{{ $language->name }} ({{ $language->name_native }})</option>
                    @endforeach
                </x-select>
                <x-select label="Years of Experience" id="experience" name="experience" group-class="col-span-6" wire:model="state.experience">
                    @php ($experiences = ['1', '2', '3', '4', '5', '5+'])
                    @foreach ($experiences as $experience)
                        <option value="{{$experience}}">{{$experience}} {{ $experience == 1 ? __('Year') : __('Years') }}</option>
                    @endforeach
                </x-select>
            @endif

        </div>
        <x-button type="submit" class="mt-7">{{ __('Save') }}</x-button>
    </x-slot>

</x-partials.form-section>
