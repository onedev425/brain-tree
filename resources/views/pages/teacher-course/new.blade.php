@extends('layouts.app')

@section('page_heading',   __('Courses'))

@section('content')
    @livewire('teacher-course-create-form')
@endsection

courses -> index, create, show, -> teacher, student -> index, show