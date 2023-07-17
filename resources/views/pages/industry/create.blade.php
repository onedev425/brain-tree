@extends('layouts.app')

@section('title',  __('Create Industry'))

@section('page_heading',   __('Create Industry'))

@section('content', )
    @livewire('industry-form', ['industry' => $industry])
@endsection
