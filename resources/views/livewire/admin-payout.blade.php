<div>
    <x-loading-spinner/>
    <div class="flex items-center justify-between">
        <div class="flex w-full items-center">
            From: <input type="date" wire:model.sebounce.500ms="fromDate" class="ml-2 mr-4 border-2 rounded-md border-black px-2 py-1" onchange="filterByDate()"/>
            To: <input type="date" wire:model.sebounce.500ms="toDate" class="ml-2 border-2 rounded-md border-black px-2 py-1" onchange="filterByDate()"/>
        </div>
        <div>
            <input id="datatable-search-{{$unique_id}}" type="search" wire:model.sebounce.500ms="search"  placeholder="Search" class="border border-gray-300 rounded-l py-2 px-4"/>
            <button class="bg-red-500 hover:bg-red-600 text-white rounded-r py-2 px-4 focus:outline-none focus:ring focus:border-red-300">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div class="overflow-x-scroll beautify-scrollbar text-center my-4 border rounded-lg">
        <table class="w-full table-auto">
            <thead class="">
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Instructor') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Courses') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Total Amount') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Payout Amount') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Action') }}</th>
            </thead>
            <tbody class="">
            @if ($teachers->isNotEmpty())
                @foreach($teachers as $teacher)
                    @php($this->payout_amounts[$teacher->id] = intval($teacher->course_amount * $this->course_fee->fee_value / 100))
                    <tr class="border-t">
                        <td class="p-4 whitespace-nowrap text-left">
                            <div class="flex">
                                <img width="50" height="50" class="rounded-full" src="{{ $teacher->profile_photo_path }}" onerror="this.src='{{ asset('images/logo/avatar.png') }}'" />
                                <a href="{{ route('teachers.show', $teacher->id) }}" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 text-purple-500">{{ $teacher->name }}</a>
                            </div>
                        </td>
                        <td class="p-4 whitespace-nowrap">{{ $teacher->courses }}</td>
                        <td class="p-4 whitespace-nowrap">{{ $teacher->course_amount }}</td>
                        <td class="p-4 whitespace-nowrap"><input type="number" name="payout_amount" class="border px-1.5 py-1.5 rounded-lg text-right" wire:model.defer="payout_amounts.{{ $teacher->id }}" /></td>
                        <td class="p-4 whitespace-nowrap">
                            <x-button wire:click="payOut({{ $teacher->id }}, {{ $teacher->course_amount }})" class="text-purple-500">{{ __('Pay') }}</x-button>
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
        {{ $teachers->links() }}
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
