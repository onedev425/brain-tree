<x-partials.form-section submit="updateProfileInformation">

    <x-slot name="form">
        <x-action-message on="saved">
            {{ __('Saved.') }}
        </x-action-message>
        <h3 class="text-xl md:text-2xl font-bold" group-class="col-span-12" >
            {{ __('Account') }}
        </h3>
        <div class="md:grid grid-cols-12 gap-4">

            <x-input label="Student First Name *" id="name" name="name" placeholder="Your First Name" group-class="col-span-6" wire:model="state.name"/>
            <x-input label="Last Name *" id="name" name="name" placeholder="Your Last Name" group-class="col-span-6" wire:model="state.name"/>
            <x-input label="Email *" id="email" name="email" placeholder="Your Email Address" group-class="col-span-6" wire:model="state.email"/>
            <x-input label="Date of Birth *" type="date" id="birthday" name="birthday" placeholder="Your birthday..." group-class="col-span-6" wire:model="state.birthday"/>
            <x-input label="Phone number* " id="phone" name="phone" placeholder="Your phone number" group-class="col-span-6" wire:model="state.phone"/>

            <x-select label="Country *" id="country" name="country" group-class="col-span-6" wire:model="state.country">
            </x-select>
            <x-select label="Industry *" id="industry" name="industry" group-class="col-span-6" wire:model="state.industry">
            </x-select>

            <x-select label="Language *" id="language" name="language" group-class="col-span-6" wire:model="state.language">
            </x-select>
        </div>
    </x-slot>
    <x-slot name="actions">
        <x-button>{{ __('Save') }}</x-button>
    </x-slot>
</x-partials.form-section>
