<div>
    <x-loading-spinner/>
    <div class="flex items-center justify-end">
        <div class="flex w-full items-center">
            From: <input type="date" wire:model.sebounce.500ms="fromDate" class="ml-2 mr-4 border-2 rounded-md border-black px-2 py-1" onchange="filterByDate()"/>
            To: <input type="date" wire:model.sebounce.500ms="toDate" class="ml-2 border-2 rounded-md border-black px-2 py-1" onchange="filterByDate()"/>
        </div>
        <input id="datatable-search-student-purchase-history" type="search" wire:model.sebounce.500ms="search"  placeholder="Search" class="border border-gray-300 rounded-l py-2 px-4"/>
        <button class="bg-red-500 hover:bg-red-600 text-white rounded-r py-2 px-4 focus:outline-none focus:ring focus:border-red-300">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="overflow-x-scroll beautify-scrollbar text-center my-4 border rounded-lg">
        <table class="w-full table-auto">
            <thead class="">
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Course') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Price') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Student') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Date Purchased') }}</th>
            </thead>
            <tbody class="text-left">
            @if ($courses->isNotEmpty())
                @foreach($courses as $course)
                    <tr class="border-t">
                        <td class="p-4 whitespace-nowrap text-left truncate">
                            <div class="flex">
                                <img width="50" height="50" class="rounded-full" src="{{ $course->image }}" onerror="this.src='{{ asset('images/logo/course.jpg') }}'" />
                                <span class="block items-center gap-2 py-3 px-6 truncate">{{ $course->title }}</span>
                            </div>

                        </td>
                        <td class="p-4 whitespace-nowrap">${{ $course->price }}</td>
                        <td class="p-4 whitespace-nowrap">{{ $course->student_name }}</td>
                        <td class="p-4 whitespace-nowrap">{{ date('m-d-Y', strtotime($course->purchase_at)) }}</td>
                    </tr>
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

<script>
function filterByDate() {
    const fromDate = document.getElementById('from').value;
    const toDate = document.getElementById('to').value;

    // Ensure "To" date is greater than or equal to "From" date
    if (toDate && fromDate && toDate < fromDate) {
        document.getElementById('to').value = fromDate
        alert('"To" date should be greater than or equal to "From" date.');
        return;
    }

    // Send filter request to Laravel controller
    const filterData = { from: fromDate, to: toDate };
}
</script>
