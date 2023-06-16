@extends('layouts.guest')

@section('title', 'Forgot password')

@section('body')
    <x-partials.authentication-card>
        <livewire:forgot-password-form />
    </x-partials.authentication-card>
@endsection
