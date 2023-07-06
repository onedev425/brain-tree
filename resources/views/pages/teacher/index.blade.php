@extends('layouts.app')

@section('title',  __('Instructors'))

@section('page_heading',   __('Instructors'))

@section('content', )
    @livewire('list-teachers-table')
@endsection
