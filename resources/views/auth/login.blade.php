@extends('layouts.guest')

@section('title', __('Login'))

@section('body')
    <x-partials.authentication-card>
        <livewire:login-form />
    </x-partials.authentication-card>
@endsection
