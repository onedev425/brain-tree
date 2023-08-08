@extends('layouts.app')

@section('title',  __('Certifications & Grades'))

@section('page_heading',   __('Certifications & Grades'))

@section('content')
    @livewire('certification-grade-form')
@endsection
