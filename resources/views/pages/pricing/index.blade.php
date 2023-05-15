@extends('layouts.app')

@section('title',  __('Pricing'))

@section('page_heading',   __('Pricing'))

@section('content')
    @livewire('pricing-form')
@endsection
