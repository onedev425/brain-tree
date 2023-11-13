@extends('layouts.app')

@section('title', $student->name . __("'s profile"))

@section('page_heading', $student->name . __("'s profile") )

@section('content')
    @livewire('edit-user-profile', ['user' => $student])
@endsection
