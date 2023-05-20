<div class="block">
    <div class="card float-left w-full">
        <div class="card-body">
            <div class="block md:flex border-b-2 border-gray-300">
                <a href="javascript:;" wire:click="setTab('progress')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'progress' ? 'border-b-4 border-green-600' : '' }}" style="{{ $activeTab === 'progress' ? '' : 'opacity: .5' }}">
                    {{ __('Progress') }} ( {{ count($progress_courses) }} )
                </a>
                <a href="javascript:;" wire:click="setTab('completed')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'completed' ? 'border-b-4 border-green-600' : '' }}"  style="{{ $activeTab === 'completed' ? '' : 'opacity: .5' }}">
                    {{ __('Completed') }} ( {{ count($completed_courses) }} )
                </a>
            </div>

            <div class="mt-8 md:mt-0 md:grid md:grid-cols-2 md:gap-4 md:pt-2 lg:grid-cols-3 lg:gap-10 lg:p-4 xl:grid-cols-3 xl:gap-10 xl:p-6 2xl:grid-cols-4 xl:gap-14 xl:p-8 ">
                @if ($activeTab === 'progress')
                    @foreach($progress_courses as $course)
                        @livewire('student-course-block', [
                            'title' => $course->title,
                            'image' => $course->image,
                            'created_by' => $course->created_by,
                            'lesson_nums' => $course->lesson_nums,
                            'quiz_nums' => $course->quiz_nums,
                            'progress' => $course->progress,
                        ])
                    @endforeach
                @else
                    @foreach($completed_courses as $course)
                        @livewire('student-course-block', [
                            'title' => $course->title,
                            'image' => $course->image,
                            'created_by' => $course->created_by,
                            'lesson_nums' => $course->lesson_nums,
                            'quiz_nums' => $course->quiz_nums,
                            'progress' => $course->progress,
                        ])
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>
