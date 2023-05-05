<x-partials.action-section>
    <x-slot name="content">
        <h3 class="text-xl md:text-2xl font-bold">
            {{ __('Two Factor Authentication') }}
        </h3>

        <p class="mt-3">
            {{ __('Two-Factor Authentication adds an additional layer of security to your account.
Each time you log in to your profile, you will be asekd to enter a uniquee code that is only available on your mobile phone. This extra protection ensures that you are the only one who wull have access to your Courses account and courses.') }}
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <p class="mt-3">
                    {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                </p>

                <div class="mt-3">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <p class="mt-3">
                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                </p>

                <div class="dark:bg-gray-500 bg-gray-100 my-2 rounded p-3">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-3">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled" class="bg-gray-500">
                        {{ __('Enable Two-Factor Authentication') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-button class=" bg-white text-black" wire:loading.attr="disabled">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-button class=" bg-white text-black">
                            {{ __('Show Recovery Codes') }}
                        </x-button>
                    </x-confirms-password>
                @endif

                <x-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-button class="bg-red-600" wire:loading.attr="disabled">
                        {{ __('Disable') }}
                    </x-button>
                </x-confirms-password>
            @endif
        </div>
    </x-slot>
</x-partials.action-section>
