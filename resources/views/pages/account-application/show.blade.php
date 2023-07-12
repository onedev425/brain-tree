@extends('layouts.app')

@section('title', __("View $applicant->name's application"))

@section('page_heading', __("View $applicant->name's application") )

@section('content')
    @livewire('show-account-application', ['applicant' => $applicant])
@endsection
