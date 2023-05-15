@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
    ['href'=> route('profile.show'), 'text'=> 'Profile' , 'active']
]])

@section('title',  __('Profile'))

@section('page_heading',  auth()->user()->hasRole('student') ? __('My Account') : __('Instructor Account'))

@section('content')
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
        @endif
@endsection
