@extends('layouts.app')

@section('title', __('Courses'))

@section('page_heading', __('Courses') . ' / ' . $course->title )

@section('content')
    @livewire('show-student-course-form', ['course' => $course, 'topics' => $topics, 'quizzes' => $quizzes, 'passed_exam' => $passed_exam])
@endsection
