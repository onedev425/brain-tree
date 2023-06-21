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
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Teacher') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Created At') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Action') }}</th>
            </thead>
            <tbody class="text-left">
            @if ($courses->isNotEmpty())
                @foreach($courses as $course)
                    <tr class="border-t">
                        <td class="p-4 whitespace-nowrap text-left">
                            <div class="flex">
                                <img width="50" height="50" class="rounded-full" src="{{ $course->image }}" onerror="this.src='{{ asset('images/logo/course.jpg') }}'" />
                                <a href="javascript:;" class="flex items-center gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 text-purple-500">{{ $course->title }}</a>
                            </div>

                        </td>
                        <td class="p-4 whitespace-nowrap">${{ $course->price }}</td>
                        <td class="p-4 whitespace-nowrap">{{ $course->assignedTeacher->name }}</td>
                        <td class="p-4 whitespace-nowrap">{{ substr($course->created_at, 0, 10) }}</td>
                        <td class="p-4 whitespace-nowrap">
                            <a href="javascript:;" class="open_quiz_dialog_link text-purple-500">{{ __('Buy Course') }}</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr w-full>
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

