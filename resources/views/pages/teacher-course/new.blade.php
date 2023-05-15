@extends('layouts.app')

@section('page_heading',   __('Course'))

@section('content')
    @livewire('teacher-course-create-form')
@endsection
