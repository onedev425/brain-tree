<div>
    <div class="card">
        <div class="card-body">
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
