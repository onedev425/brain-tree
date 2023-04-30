@extends('layouts.guest')

@section('title', 'Login')

@section('body')
    <x-partials.authentication-card>
        <livewire:login-form />
    </x-partials.authentication-card>
@endsection
