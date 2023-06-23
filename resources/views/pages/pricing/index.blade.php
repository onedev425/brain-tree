@extends('layouts.app')

@section('title',  __('Pricing'))

@section('page_heading',   __('Pricing'))

@section('content')
    @if (auth()->user()->hasRole('teacher') || auth()->user()->hasRole('super-admin'))
        @livewire('teacher-pricing-form')
    @else
        @livewire('student-pricing-form')
    @endif
@endsection
