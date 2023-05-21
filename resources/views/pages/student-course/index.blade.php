@extends('layouts.app')

@section('page_heading',   __('Courses'))

@section('content')
    @livewire('student-course-main-form')
@endsection
