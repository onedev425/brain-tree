@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

@section('page_heading',   __('Announcements'))

@section('content')
    @livewire('teacher-announcement-create-form', ['announcements' => $announcements, 'courses' => $courses])
@endsection
