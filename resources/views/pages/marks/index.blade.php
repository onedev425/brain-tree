@extends('layouts.app')

@section('title',  __('Marks'))

@section('page_heading',   __('Marks'))

@section('content')
    @livewire('marks-form')
@endsection
