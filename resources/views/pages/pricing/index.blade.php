@extends('layouts.app')

@section('title',  __('Pricing'))

@section('page_heading',   __('Pricing'))

@section('content')
    @if (auth()->user()->roles[0]->name == 'teacher')
        @livewire('teacher-pricing-form')
    @else
        @livewire('student-pricing-form')
    @endif
@endsection
