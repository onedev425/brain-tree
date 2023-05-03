@extends('layouts.app')

@section('title',  __('Profile'))

@section('content')
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
        @endif
@endsection
