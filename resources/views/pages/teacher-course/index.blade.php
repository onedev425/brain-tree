@extends('layouts.app')

@section('page_heading',   __('Course'))

@section('content')
    @livewire('teacher-course-main-form')
@endsection
