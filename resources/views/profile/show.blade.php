@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard'],
    ['href'=> route('profile.show'), 'text'=> 'Profile' , 'active']
]])

@section('title',  __('Profile'))

@section('page_heading',  'Profile')

@section('content')
        @if (auth()->user()->hasRole('applicant'))
            @livewire('application-history', ['applicant' => auth()->user()])
        @endif
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
        @endif
@endsection
