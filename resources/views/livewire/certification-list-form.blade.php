<div>
    <div class="card">
        <div class="card-header mb-5">
            <h3 class="card-title">{{ __('Your Certifications') }}</h3>
        </div>
        <div class="card-body">
            @if (count($completed_courses) == 0)
                {{ __('You have no certification. If you pass any course, you will get the certification.') }}
            @endif
            @foreach($completed_courses as $course)
                @livewire('certification-block', [
                    'course_id' => $course->id,
                    'course_title' => $course->title,
                    'teacher' => $course->assignedTeacher->name,
                    'marks' => $this->getPointsOfStudentExam($course),
                    'course_points' => $this->getCourseTotalPoints($course),
                    'completed_date' => $this->getCourseCompletedDate($course),
                    'started_date' => $this->getCourseStartedDate($course),
                    'course_rate' => $course->course_rate(),
                    'course_feedback_nums' => $course->course_feedback_nums(),
                ])
            @endforeach
        </div>
    </div>
</div>
