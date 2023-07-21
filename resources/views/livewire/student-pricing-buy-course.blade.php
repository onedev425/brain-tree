<div>
    <x-loading-spinner/>
    <div class="flex items-center justify-end">
        <input id="datatable-search-buy-course" type="search" wire:model.sebounce.500ms="search"  placeholder="Search" class="border border-gray-300 rounded-l py-2 px-4"/>
        <button class="bg-red-500 hover:bg-red-600 text-white rounded-r py-2 px-4 focus:outline-none focus:ring focus:border-red-300">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="overflow-x-scroll beautify-scrollbar text-center my-4 border rounded-lg">
        <table class="w-full table-auto">
            <thead class="">
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Course') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Price') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Instructor') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Created At') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Action') }}</th>
            </thead>
            <tbody class="text-left">
            @if ($courses->isNotEmpty())
                @foreach($courses as $course)
                    <tr class="border-t">
                        <td class="p-4 whitespace-nowrap text-left">
                            <div class="flex mt-3">
                                <img class="rounded-full w-12 h-12" src="{{ $course->image }}" onerror="this.src='{{ asset('images/logo/course.jpg') }}'" />
                                <div>
                                    <span class="flex items-center gap-2 px-6">{{ $course->title }}</span>
                                    <div class="flex px-6 pb-3">
                                        <span class="text-white bg-orange-500 text-sm px-1 mr-1 h-5">{{ number_format(round($course->course_rate(), 1), 1) }}</span>
                                        <span id="course_{{$course->id}}_rating" class="rating-progress mt-0.5 mr-2"></span>
                                        <span class="text-sm leading-4 mt-0.5">({{ $course->course_feedback_nums() }} {{ __('reviews') }})</span>
                                        @php( $rating_progress = intval($course->course_rate() / 5 * 100) . '%' ?? 0 )
                                    </div>
                                </div>

                            </div>

                        </td>
                        <td class="p-4 whitespace-nowrap">${{ $course->price }}</td>
                        <td class="p-4 whitespace-nowrap">{{ $course->assignedTeacher->name }}</td>
                        <td class="p-4 whitespace-nowrap">{{ date('m-d-Y', strtotime($course->created_at)) }}</td>
                        <td class="p-4 whitespace-nowrap">
                            <x-button wire:click="BuyCourse({{ $course->id }})" class="text-purple-500">{{ __('Buy Course') }}</x-button>
                        </td>
                    </tr>
                    <style>
                        span#course_{{$course->id}}_rating::after {
                            width: {{ $rating_progress }};
                        }
                    </style>
                @endforeach
            @else
                <tr>
                    <td class="p-4 capitalize" colspan="100%">{{ __('No data to show') }}</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="my-3">
        {{ $courses->links() }}
    </div>
</div>

