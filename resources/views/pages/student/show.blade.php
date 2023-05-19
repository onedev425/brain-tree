@extends('layouts.app')

@section('title', __('Students'))

@section('page_heading', __('Students') . ' / ' . $student->name )

@section('content')
    @livewire('show-student-profile', ['student' => $student])
@endsection
