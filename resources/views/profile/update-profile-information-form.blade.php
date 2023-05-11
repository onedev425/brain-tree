<x-partials.form-section submit="updateProfileInformation">
    <x-slot name="form">
            <x-action-message on="saved">
                {{ __('Saved.') }}
            </x-action-message>
        <div class="md:grid grid-cols-12 gap-4">
            <x-input label="Name" id="name" name="name" placeholder="Your First Name, Last Name" group-class="col-span-6" wire:model="state.name"/>
            <x-input label="Email" id="email" name="email" placeholder="Your Email Address" group-class="col-span-6" wire:model="state.email"/>
            <x-input type="date" id="birthday" name="birthday" placeholder="Your birthday..." label="Birthday *" group-class="col-span-6" wire:model="state.birthday"/>
    
            <x-select id="gender" name="gender" label="Gender *" group-class="col-span-6" wire:model="state.gender">
                @php ($genders = ['Male', 'Female'])
                @foreach ($genders as $gender)
                    <option value="{{$gender}}" >{{$gender}}</option>
                @endforeach
            </x-select>
            <x-input id="city" name="city" label="City *" placeholder="Your City" group-class="col-span-6" wire:model="state.city"/>

            <x-input id="phone" name="phone" label="Phone number" placeholder="Your phone number" group-class="col-span-6" wire:model="state.phone"/>
            <x-textarea id="address" name="address" placeholder="Your Address" group-class="col-span-12" label="Address *" wire:model="state.address"/>
        </div>
    </x-slot>
    <x-slot name="actions">
        <x-button class="w-6/12 lg:w-3/12">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-partials.form-section>