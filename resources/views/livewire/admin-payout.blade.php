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
            <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Instructor') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Courses') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Total Earning') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Payout Fee') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Payout At') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Action') }}</th>
            </thead>
            <tbody class="">
            @if ($teachers->isNotEmpty())
                @foreach($teachers as $teacher)
                    <tr class="border-t">
                        <td class="p-4 whitespace-nowrap text-left">
                            <div class="flex">
                                <img width="50" height="50" class="rounded-full" src="{{ $teacher->profile_photo_path }}" onerror="this.src='{{ asset('images/logo/avatar.png') }}'" />
                                <a href="{{ route('teachers.show', $teacher->id) }}" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 text-purple-500">{{ $teacher->name }}</a>
                            </div>
                        </td>
                        <td class="p-4 whitespace-nowrap">{{ $teacher->courses }}</td>
                        <td class="p-4 whitespace-nowrap">{{ '$ ' . $teacher->earning_amount ?? 0 }}</td>
                        <td class="p-4 whitespace-nowrap w-14">
                            @if ($teacher_id == $teacher->id)
                                <!-- Display input field when editing -->
                                <input type="text" class="border border-gray-500 p-2 rounded bg-inherit w-10" wire:model.defer="fee_amount"> %
                            @else
                                <!-- Display fee amount when not editing -->
                                {{ $teacher->fee_amount . '%' }}
                            @endif
                        </td>
                        <td class="p-4 whitespace-nowrap w-40">
                            @if ($teacher_id == $teacher->id)
                                <!-- Display input field when editing -->
                                <input type="date" class="border border-gray-500 p-2 rounded bg-inherit w-36" wire:model.defer="payout_at">
                            @else
                                <!-- Display fee amount when not editing -->
                                {{ (new DateTime($teacher->payout_at))->format("m/d Y") }}
                            @endif
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            @if ($teacher_id == $teacher->id)
                                <x-button class="text-purple-500" wire:click="savePayoutFee">{{ __('Save Fee') }}</x-button>
                            @else
                                <x-button class="text-purple-500" wire:click="updatePayoutFee('{{ $teacher->id }}', '{{ $teacher->fee_amount }}', '{{ $teacher->payout_at }}')">{{ __('Edit Fee') }}</x-button>
                            @endif
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
