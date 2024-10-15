@extends('layouts.app')

@section('page_heading',   __('Announcements'))

@section('content')
    @livewire('teacher-announcement-main-form', ['announcements' => $announcements, 'courses'=>$courses])
@endsection
