@extends('layouts.app')

@section('title', __('Courses'))

@section('page_heading', __('Courses') . ' / ' . 'Learn Web Design & Development' )

@section('content')
    @livewire('show-student-course-form')
@endsection
