@extends('layouts.app')

@section('title',  __('Students'))

@section('page_heading',   __('Students'))

@section('content', )
    @livewire('list-students-table')
@endsection
