@extends('layouts.app')

@section('title', $teacher->name . __("'s profile"))

@section('page_heading', $teacher->name . __("'s profile") )

@section('content')
    @livewire('show-teacher-profile', ['teacher' => $teacher])
@endsection
