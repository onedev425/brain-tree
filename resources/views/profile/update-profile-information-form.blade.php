<x-partials.form-section submit="updateProfileInformation">
    <x-slot name="form">
            <x-action-message on="saved">
                {{ __('Saved.') }}
            </x-action-message>

        <div class="md:grid grid-cols-12 gap-4">
            <x-input label="Name" id="name" name="name" placeholder="Your Name In Order First Name, Last Name, Other names " group-class="col-span-12" wire:model="state.name"/>
            <x-input label="Email" id="email" name="email" placeholder="Your Email Address" group-class="col-span-12" wire:model="state.email"/>
            <x-input type="date" id="birthday" name="birthday" placeholder="Your birthday..." label="Birthday *" group-class="col-span-6" wire:model="state.birthday"/>

            <x-select id="gender" name="gender" label="Gender *" group-class="col-span-6" wire:model="state.gender">
                @php ($genders = ['Male', 'Female'])
                @foreach ($genders as $gender)
                    <option value="{{$gender}}" >{{$gender}}</option>
                @endforeach
            </x-select>
            <!--nationality and state-->
            <div class="col-span-12">
                @livewire('nationality-and-state-input-fields', ['nationality' => ucfirst($this->user->nationality), 'state' => ucfirst($this->user->state)])
            </div>

            {{-- listen for change in nationality and state event and set it as the value of their respective state variable. The values of $state is passed on form submit. therefore we set the selected nationality using the browser event fired  --}}
            <script>
                window.addEventListener('nationality-updated',event => {
                    @this.set('state.nationality', event.detail.nationality)
               })
               window.addEventListener('state-updated',event => {
                    @this.set('state.state', event.detail.state)
               })
            </script>
            <x-input id="city" name="city" label="City *" placeholder="Your City" group-class="col-span-6" wire:model="state.city"/>

            <x-input id="phone" name="phone" label="Phone number" placeholder="Your phone number" group-class="col-span-6" wire:model="state.phone"/>
            <x-textarea id="address" name="address" placeholder="Your Address" group-class="col-span-12" label="Address *" wire:model="state.address"/>
            <x-select id="religion" name="religion" label="Religion *" group-class="col-span-6" wire:model="state.religion">
                @php ($religions = ['Christianity', 'Islam', 'Hinduism', 'Buddhism', 'Other'])
                @foreach ($religions as $religion)
                    <option value="{{$religion}}">{{$religion}}</option>
                @endforeach
            </x-select>
            <x-select id="blood-group" name="blood_group" label="Blood group *" group-class="col-span-6" wire:model="state.blood_group">
                @php ($bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'Ab-', 'O+', 'O-'])
                @foreach ($bloodGroups as $bloodGroup)
                    <option value="{{$bloodGroup}}">{{$bloodGroup}}</option>
                @endforeach
            </x-select>
        </div>
    </x-slot>
    <x-slot name="actions">
        <x-button class="w-6/12 lg:w-3/12">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-partials.form-section>
