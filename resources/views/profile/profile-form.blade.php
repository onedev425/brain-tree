<form action="{{ route('profile.update') }}" method="POST" class="w-full">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Account') }}</h3>
        </div>
        <div class="card-body">

            <div class="md:grid grid-cols-12 gap-4">
                @if (auth()->user()->hasRole('student'))
                    <x-input label="User Name *" id="name" name="name" placeholder="Your Full Name" group-class="col-span-12" wire:model="state.name"/>
                    <x-input label="Email *" id="email" name="email" placeholder="Your Email Address" group-class="col-span-6" wire:model="state.email"/>
                    <x-input label="Date of Birth *" type="date" id="birthday" name="birthday" placeholder="Your birthday..." group-class="col-span-6" wire:model="state.birthday"/>
                    <x-input label="Phone number* " id="phone" name="phone" placeholder="Your phone number" group-class="col-span-6" wire:model="state.phone"/>

                    <x-select label="Country *" id="country" name="country" group-class="col-span-6" wire:model="state.country_id" wire:init="setDefaultCountry">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Industry *" id="industry" name="industry" group-class="col-span-6" wire:model="state.industry_id">
                        @foreach ($industries as $industry)
                            <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Language *" id="language" name="language" group-class="col-span-6" wire:model="state.language_id" wire:init="setDefaultLanguage">
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->name }} ({{ $language->name_native }})</option>
                        @endforeach
                    </x-select>
                @else
                    <x-input label="User Name *" id="name" name="name" placeholder="Your Full Name" group-class="col-span-12" wire:model="state.name"/>
                    <x-input label="Email *" id="email" name="email" placeholder="Your Email Address" group-class="col-span-6" wire:model="state.email"/>
                    <x-input label="Phone number* " id="phone" name="phone" placeholder="Your phone number" group-class="col-span-6" wire:model="state.phone"/>

                    <x-select label="Country *" id="country" name="country" group-class="col-span-6" wire:model="state.country_id" wire:init="setDefaultCountry">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Industry *" id="industry" name="industry" group-class="col-span-6" wire:model="state.industry_id">
                        @foreach ($industries as $industry)
                            <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Language *" id="language" name="language" group-class="col-span-6" wire:model="state.language_id" wire:init="setDefaultLanguage">
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->name }} ({{ $language->name_native }})</option>
                        @endforeach
                    </x-select>
                    <x-select label="Years of Experience *" id="experience" name="experience" group-class="col-span-6" wire:model="state.experience">
                        @php ($experiences = ['1', '2', '3', '4', '5', '5+'])
                        @foreach ($experiences as $experience)
                            <option value="{{$experience}}">{{$experience}} {{ $experience == 1 ? __('Year') : __('Years') }}</option>
                        @endforeach
                    </x-select>
                @endif

            </div>
            <x-button type="submit" class="mt-7">{{ __('Save') }}</x-button>
        </div>
    </div>
</form>
