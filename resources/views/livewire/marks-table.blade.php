<div>
    <x-loading-spinner/>
    <div class="flex items-center justify-end">
        <input id="datatable-search-{{$unique_id}}" type="search" wire:model.sebounce.500ms="search"  placeholder="Search" class="border border-gray-300 rounded-l py-2 px-4"/>
        <button class="bg-red-500 hover:bg-red-600 text-white rounded-r py-2 px-4 focus:outline-none focus:ring focus:border-red-300">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="overflow-x-scroll beautify-scrollbar text-center my-4 border rounded-lg">
        <table class="w-full table-auto">
            <thead class="">
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Name') }}</th>
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Course') }}</th>
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Marked Score') }}</th>
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Action') }}</th>
            </thead>
            <tbody class="text-left">
            @if ($students->isNotEmpty())
                @foreach($students as $student)
                    <tr class="border-t">
                        <td class="p-4 whitespace-nowrap text-left">
                            <div class="flex">
                                <img width="50" height="50" class="rounded-full" src="{{ $student->student_photo }}" onerror="this.src='{{ asset('images/logo/avatar.png') }}'" />
                                <a href="{{ route('students.show', $student->student_id) }}" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 text-purple-500">{{ $student->student_name }}</a>
                            </div>

                        </td>
                        <td class="p-4 whitespace-nowrap">{{ $student->course_title }}</td>
                        <td class="p-4 whitespace-nowrap">{{ $student->student_points }} / {{ $student->total_points }}</td>
                        <td class="p-4 whitespace-nowrap">
                            <a href="javascript:;" class="open_quiz_dialog_link text-purple-500" data-quiz-info="">{{ __('Show answers') }}</a>
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
        {{ $students->links() }}
    </div>
</div>
