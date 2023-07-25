<div class="block">
    <div class="card float-left w-full">
        <div class="card-body">
            <div class="block md:flex border-b-2 border-gray-300">
                <a href="javascript:;" wire:click="setTab('progress')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'progress' ? 'border-b-4 border-green-600' : '' }}" style="{{ $activeTab === 'progress' ? '' : 'opacity: .5' }}">
                    {{ __('Progress') }} ( {{ count($progress_courses) }} )
                </a>
                <a href="javascript:;" wire:click="setTab('completed')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'completed' ? 'border-b-4 border-green-600' : '' }}"  style="{{ $activeTab === 'completed' ? '' : 'opacity: .5' }}">
                    {{ __('Completed') }} ( {{ count($completed_courses) }} )
                </a>
            </div>

            <div class="mt-8 lg:mt-0 lg:grid lg:gap-4 lg:grid-cols-2 lg:p-4 xl:grid-cols-3 xl:gap-4 xl:p-8 2xl:grid-cols-4 2xl:gap-8">
                @if ($activeTab === 'progress')
                    @foreach($progress_courses as $course)
                        @livewire('student-course-block', [
                            'course_id' => $course->id,
                            'title' => $course->title,
                            'image' => $course->image,
                            'teacher' => $course->assignedTeacher->name,
                            'lesson_nums' => count($course->lessons),
                            'quiz_nums' => count($course->questions),
                            'progress' => $this->getCourseProgressPercent($course),
                            'rate' => $course->course_rate(),
                            'feedback_nums' => $course->course_feedback_nums(),
                        ])
                    @endforeach
                @else
                    @foreach($completed_courses as $course)
                        @livewire('student-course-block', [
                            'course_id' => $course->id,
                            'title' => $course->title,
                            'image' => $course->image,
                            'teacher' => $course->assignedTeacher->name,
                            'lesson_nums' => count($course->lessons),
                            'quiz_nums' => count($course->questions),
                            'progress' => $this->getCourseProgressPercent($course),
                            'rate' => $course->course_rate(),
                            'feedback_nums' => $course->course_feedback_nums(),
                        ])
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>
