@extends('layouts.app')

@section('title',  __('Pricing'))

@section('page_heading',   __('Pricing'))

@section('content')
    @if (auth()->user()->hasRole('super-admin'))
        @livewire('admin-pricing-form')
    @elseif (auth()->user()->hasRole('teacher'))
        @livewire('teacher-pricing-form')
    @else
        @livewire('student-pricing-form')
    @endif
@endsection
