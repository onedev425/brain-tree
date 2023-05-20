@extends('layouts.app')

@section('title',  __('Certifications & Marks'))

@section('page_heading',   __('Certifications & Marks'))

@section('content')
    @livewire('certification-list-form')
@endsection
