@extends('layouts.app')

@section('title',  __('Purchases'))

@section('page_heading',   __('Purchases'))

@section('content')
    @if (auth()->user()->hasRole('super-admin'))
        @livewire('admin-pricing-form')
    @elseif (auth()->user()->hasRole('teacher'))
        @livewire('teacher-pricing-form')
    @else
        @livewire('student-pricing-form')
    @endif
@endsection
