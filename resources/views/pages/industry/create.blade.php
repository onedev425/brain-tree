@extends('layouts.app')

@section('title',  __('Create Category'))

@section('page_heading',   __('Create Category'))

@section('content', )
    @livewire('industry-form', ['industry' => $industry])
@endsection
