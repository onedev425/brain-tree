<div class="flex flex-col bg-white mb-12 md:mb-0 rounded-2xl border overflow-hidden">
    <div class="relative border-b">
        <span>
            <div class="absolute inset-0 hover:bg-white opacity-0 transition duration-700 hover:opacity-10"></div>
            <img class="w-full h-48 object-cover" src="{{ $image }}" alt="alt title">
        </span>
    </div>
    <div class="p-4 flex-1">
        <div class="mb-2">
            <span class="text-xs">{{ date('m-d-Y', strtotime($created_at)) }}</span>
        </div>
        <div class="">
            <h3 class="course-title text-lg leading-normal mb-3 font-bold text-gray-800">
                <span>{{ $title }}</span>
            </h3>
            <div class="flex mb-3">
                <span class="text-white bg-orange-500 text-sm px-1 mr-1 h-5">{{ number_format(round($rate, 1), 1) }}</span>
                <span id="course_{{$course_id}}_rating" class="rating-progress mt-0.5 mr-2"></span>
                <span class="text-sm leading-4">({{ $feedback_nums }} {{ __('reviews') }})</span>
                @php( $rating_progress = intval($rate / 5 * 100) . '%' ?? 0 )
            </div>
            <div class="flex h-2 overflow-hidden bg-green-100 rounded mb-4">
                <div class="flex flex-col justify-center overflow-hidden text-white text-center whitespace-nowrap bg-green-400" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="flex text-gray-500 justify-between">
                <span class="text-xs">{{ $lesson_nums }} Lessons | {{ $quiz_nums }} Quizzes</span>
                <span class="text-xs">{{ $progress }}%</span>
            </div>
        </div>
    </div>
</div><!-- end card -->
<style>
    span#course_{{$course_id}}_rating::after {
        width: {{ $rating_progress }};
    }
</style>
