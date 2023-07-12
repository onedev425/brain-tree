@extends('layouts.app')
@section('title', __("Edit $applicant->name's application"))

@section('page_heading', __("Edit $applicant->name's application"))

@section('content')
@livewire('edit-account-application-form', ['applicant' => $applicant])
@endsection
