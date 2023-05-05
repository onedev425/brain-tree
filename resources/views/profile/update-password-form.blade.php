
<x-partials.form-section submit="updatePassword">
    <x-slot name="form">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <h3 class="text-xl md:text-2xl font-bold">
                    {{ __('Password Change') }}
                </h3>

                <p class="mt-3">
                    {{ __('To change your password, simply log in to your account and navigate to the password change section.') }}
                </p>
                <x-action-message on="saved">
                    {{ __('Updated password') }}
                </x-action-message>
                <div class="w-md-75">
                    <div class="form-group">
                        <x-input id="current_password" type="password"
                                 wire:model.defer="state.current_password" autocomplete="current-password" name="current_password" label="Current Password"/>
                    </div>

                    <div class="form-group">
                        <x-input label="New Password" name="password" id="password" type="password"
                                 wire:model.defer="state.password" autocomplete="new-password" />
                    </div>

                    <div class="form-group">
                        <x-input name="password_confirmation" label="Confirm Password" id="password_confirmation" type="password"
                                 wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                    </div>
                </div>
            </div>
            <!-- ... -->
            <div class="mx-3">
                <div class="bg-gray-200 p-5 rounded-2xl">
                    Be sure to create a strong and unique password that includes a combination of letters, numbers, and symbols, and avoid using the same password for multiple accounts. If you have any trouble changing your password, don't hesitate to reach out to our support team for assistance.
                    <ul class="mx-5 mt-5 list-disc ">
                        <li>Minimum 8 character</li>
                        <li>At least one special character</li>
                        <li>At least one number</li>
                        <li>Can't be the same as a  previous</li>
                    </ul>
                </div>

            </div>
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-button class="w-6/12 lg:w-3/12 mb-10">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-partials.form-section>
