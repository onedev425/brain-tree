@extends('layouts.app')

@section('title',  __("Edit $industry->name"))

@section('page_heading',   __("Edit $industry->name"))

@section('content', )
    @livewire('industry-form', ['industry' => $industry])
@endsection
