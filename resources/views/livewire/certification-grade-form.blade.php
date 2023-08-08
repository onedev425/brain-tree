<div class="block">
    <div class="card float-left w-full">
        <div class="card-body">
            <div class="block md:flex border-b-2 border-gray-300">
                <a href="javascript:;" wire:click="setTab('certification')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'certification' ? 'border-b-4 border-green-600' : '' }}" style="{{ $activeTab === 'certification' ? '' : 'opacity: .5' }}">
                    {{ __('Certification') }}
                </a>
                <a href="javascript:;" wire:click="setTab('grade')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'grade' ? 'border-b-4 border-green-600' : '' }}"  style="{{ $activeTab === 'grade' ? '' : 'opacity: .5' }}">
                    {{ __('Grades') }}
                </a>
            </div>

            @if ($activeTab === 'certification')
                <div class="">
                    <h3 class="py-4 text text-2xl font-bold">{{ __('Your Certifications') }}</h3>
                    <div class="my-4">
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
            @else
                @livewire('certification-grade-list')
            @endif
        </div>

    </div>
</div>
