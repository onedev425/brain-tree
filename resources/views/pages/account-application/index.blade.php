@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('home'), 'text'=> 'Dashboard'],
    ['href'=> route('account-applications.index'), 'text'=> 'Account Applications', 'active'],
]])

@section('title',  __('Account Applications'))

@section('page_heading',   __('Account Applications'))

@section('content', )
    @livewire('list-account-applications-table')
@endsection
