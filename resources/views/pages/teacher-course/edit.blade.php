@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

@section('page_heading',   __('Courses'))

@section('content')
    @livewire('teacher-course-create-form', ['course' => $course, 'topics' => $topics, 'quizzes' => $quizzes])
@endsection
