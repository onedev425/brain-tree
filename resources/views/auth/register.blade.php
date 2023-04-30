@extends('layouts.guest')

@section('title', 'Login')

@section('body')
    <x-partials.authentication-card>
{{--        <x-display-validation-errors />--}}
        <livewire:login-form activeTab="register" />
    </x-partials.authentication-card>
@endsection
