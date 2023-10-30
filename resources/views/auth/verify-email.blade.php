@extends('layouts.guest')

@section('title', 'Verify Email')

@section('body')
    <x-partials.authentication-card>
        <div class="p-4">
            <x-display-validation-errors />
            @if (session('status') == 'verification-link-sent')
                <x-alert title="Verification Link Sent" icon="fa fa-check" colour="bg-green-500">
                    <p class="text-sm md:text-base">{{__('A new verification link has been sent to the email address you provided during registration.')}}</p>
                </x-alert>
            @endif
            <div class="my-3 text-sm md:text-base">
                {{ __('Please check your email inbox for the verification link that has been sent to you. It is important to complete this step to confirm your email address. If you are unable to find the email, please check your spam folder. If you have received it, please click "resend" to try again.') }}
            </div>
            <div class="mt-4 flex-col items-center flex justify-between">
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <div>
                        <x-button type="submit">
                            {{ __('Resend Verification Email') }}
                        </x-button>
                    </div>
                </form>

                <form method="POST" action="/logout">
                    @csrf

                    <button type="submit" class="text-center p-3">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-partials.authentication-card>
@endsection
