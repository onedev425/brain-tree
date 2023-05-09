@extends('layouts.app')

@section('title',  __('Profile'))

@section('page_heading',  __('Security & Settings'))

@section('content')
    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        @livewire('profile.two-factor-authentication-form')
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div id="update-password">
            @livewire('profile.update-password-form')
        </div>
    @endif
@endsection
