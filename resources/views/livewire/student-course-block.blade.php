<div class="flex flex-col bg-white mb-12 md:mb-0 rounded-2xl border overflow-hidden">
    <div class="relative border-b">
        <a href="{{ route('student.course.show', $course_id) }}">
            <div class="absolute inset-0 hover:bg-white opacity-0 transition duration-700 hover:opacity-10"></div>
            <img class="w-full h-48 object-cover" src="{{ $image }}" alt="alt title">
        </a>
    </div>
    <div class="p-4 flex-1">
        <div class="mb-2">
            <span class="text-xs">{{ $created_by }}</span>
        </div>
        <div class="">
            <h3 class="text-lg leading-normal mb-3 font-bold text-gray-800">
                <a href="{{ route('student.course.show', $course_id) }}" class="hover:text-indigo-700">{{ $title }}</a>
            </h3>
            <div class="flex h-2 overflow-hidden bg-green-100 rounded mb-4">
                <div class="flex flex-col justify-center overflow-hidden text-white text-center whitespace-nowrap bg-green-400" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="flex text-gray-500 justify-between">
                <span class="text-xs">{{ $lesson_nums }} Lessons | {{ $quiz_nums }} Quizzes</span>
                <span class="text-xs">{{ $progress }}%</span>
            </div>
            <div class="mt-2">
                <button class="md:px-5 bg-red-700 text-xs font-semibold border-transparent uppercase hover:bg-opacity-90 active:bg-opacity-70 text-white py-2 px-4 border-2 rounded-md my-3">
                    {{ __('Resume') . ' >' }}
                </button>
            </div>
        </div>
    </div>
</div><!-- end card -->

