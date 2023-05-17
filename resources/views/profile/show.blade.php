@extends('layouts.app')

@section('title',  __('Profile'))

@section('page_heading',  __('Profile'))

@section('content')
        @if (auth()->user()->hasRole('applicant'))
            @livewire('application-history', ['applicant' => auth()->user()])
        @endif
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @if (auth()->user()->hasRole('student'))
                @livewire('student-profile-form')
            @else
                @livewire('teacher-profile-form')
            @endif
        @endif
@endsection
