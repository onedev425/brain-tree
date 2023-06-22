<div class="block">
    <div class="float-right my-4 {{ auth()->user()->hasRole('super-admin') ? 'hidden' : '' }}">
        <a href="{{ route('teacher.course.create') }}" class="bg-red-600 uppercase hover:bg-opacity-90 active:bg-opacity-70 text-white py-2 px-4 border-2 rounded-lg my-3">
            <i class="fa fa-plus" aria-hidden="true"></i>
            {{ __('Create new course') }}
        </a>
    </div>
    <div class="card float-left w-full mt-2">
        <div class="card-body">
            <div class="block md:flex mt-4 border-b-2 border-gray-300">
                <a href="javascript:;" wire:click="setTab('publish')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'publish' ? 'border-b-4 border-green-600' : '' }}" style="{{ $activeTab === 'publish' ? '' : 'opacity: .5' }}">
                    {{ __('Publish') }} ({{ count($publish_courses) }})
                </a>
                <a href="javascript:;" wire:click="setTab('draft')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'draft' ? 'border-b-4 border-green-600' : '' }}"  style="{{ $activeTab === 'draft' ? '' : 'opacity: .5' }}">
                    {{ __('Draft') }} ({{ count($draft_courses) }})
                </a>
            </div>

            <div class="mt-8 lg:mt-0 lg:grid lg:gap-4 lg:grid-cols-2 lg:p-4 xl:grid-cols-3 xl:gap-4 xl:p-8 2xl:grid-cols-4 2xl:gap-8">
                @if ($activeTab === 'publish')
                    @foreach($publish_courses as $course)
                        @livewire('teacher-course-block', [
                            'course_id' => $course->id,
                            'title' => $course->title,
                            'image' => $course->image,
                            'created_at' => $course->created_at,
                            'duration' => $this->getCourseVideoDuration($course),
                            'price' => $course->price,
                            'is_published' => $course->is_published,
                        ])
                    @endforeach
                @else
                    @foreach($draft_courses as $course)
                        @livewire('teacher-course-block', [
                            'course_id' => $course->id,
                            'title' => $course->title,
                            'image' => $course->image,
                            'created_at' => $course->created_at,
                            'duration' => $this->getCourseVideoDuration($course),
                            'price' => $course->price,
                            'is_published' => $course->is_published,
                        ])
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>
