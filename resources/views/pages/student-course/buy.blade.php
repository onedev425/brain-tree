@extends('layouts.app')

@section('title', __('Courses'))

@section('page_heading', __('Courses') . ' / ' . $course->title )

@section('content')
    @livewire('buy-course-view', ['course' => $course, 'lessons' => $lessons, 'questions' => $questions, 'topics' => $topics, 'video_duration' => $video_duration])
@endsection
