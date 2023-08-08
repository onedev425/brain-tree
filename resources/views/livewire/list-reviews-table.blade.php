<div class="card">
    <div class="card-body">
        <div>
    <x-loading-spinner/>
    <div class="flex items-center justify-end">
        <input id="datatable-search-{{$unique_id}}" type="search" wire:model.sebounce.500ms="search"  placeholder="Search" class="border border-gray-300 rounded-l py-2 px-4"/>
        <button class="bg-red-500 hover:bg-red-600 text-white rounded-r py-2 px-4 focus:outline-none focus:ring focus:border-red-300">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="block md:flex mt-4">
        <a href="/reviews?type=all" class="py-2 px-2 lg:px-4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'all' ? 'border-b-4 border-green-600' : '' }}" style="{{ $activeTab === 'all' ? '' : 'opacity: .5' }}">
            {{ __('All') }}
        </a>
        <a href="/reviews?type=approved" class="py-2 px-2 lg:px-4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'approved' ? 'border-b-4 border-green-600' : '' }}"  style="{{ $activeTab === 'approved' ? '' : 'opacity: .5' }}">
            {{ __('Approved') }}
        </a>
        <a href="/reviews?type=unapproved" class="py-2 px-2 lg:px-4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'unapproved' ? 'border-b-4 border-green-600' : '' }}"  style="{{ $activeTab === 'unapproved' ? '' : 'opacity: .5' }}">
            {{ __('Unapproved') }}
        </a>
        <a href="/reviews?type=trash" class="py-2 px-2 lg:px-4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'trash' ? 'border-b-4 border-green-600' : '' }}"  style="{{ $activeTab === 'trash' ? '' : 'opacity: .5' }}">
            {{ __('Trash') }}
        </a>
    </div>
    <x-dropdown buttonLabel="Bulk actions" buttonClass="flex flex-row-reverse items-center">
        <span id="bulk-approve-action" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 cursor-pointer">{{ __('Approve') }}</span>
        <span id="bulk-unapprove-action" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 cursor-pointer">{{ __('Unpprove') }}</span>
        <span id="bulk-trash-action" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 cursor-pointer">{{ __('Move to trash') }}</span>
    </x-dropdown>
    <div class="overflow-x-scroll beautify-scrollbar text-center my-4 border rounded-lg">
        <table class="w-full table-auto">
            <thead class="text-md text-gray-700">
                <th>
                    <input type="checkbox" id="course-feedback-check-all"/>
                </th>
                <th class="capitalize p-3 whitespace-nowrap text-left">{{ __('Student') }}</th>
                <th class="capitalize p-2 whitespace-nowrap text-left">{{ __('Rate') }}</th>
                <th class="capitalize p-3 whitespace-nowrap text-left">{{ __('Comment') }}</th>
                <th class="capitalize p-2 whitespace-nowrap text-left">{{ __('Submitted on') }}</th>
            </thead>
            <tbody>
                @if ($all_reviews->isNotEmpty())
                    @foreach($all_reviews as $review)
                        <tr class="border-t">
                            <td class="whitespace-nowrap">
                                <input type="checkbox" class="course-feedback-item" data-id={{ $review->id }}>
                            </td>
                            <td class="p-3 whitespace-nowrap text-left">
                                <div class="flex flex-col">
                                    <span class="font-bold text-lg">{{ $review->teacher_name }}</span>
                                    <span class="text-sm text-red-500" class="font-bold text-lg">{{ $review->course_title }}</span>
                                </div>
                            </td>
                            <td class="p-3 whitespace-nowrap text-left">
                                <div class="flex">
                                    <span class="text-white bg-orange-500 text-sm px-1 mr-1 h-5">{{ number_format(round($review->rate, 1), 1) }}</span>
                                    <span id="course_{{$review->id}}_rating" class="rating-progress mt-0.5 mr-2"></span>
                                    @php( $rating_progress = intval($review->rate / 5 * 100) . '%' ?? 0 )
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap text-left">
                                {{ $review->content }}
                            </td>
                            <td class="p-2 whitespace-nowrap text-left">
                                {{ date('m-d-Y', strtotime($review->feedback_at)) }}
                            </td>
                            <style>
                                span#course_{{$review->id}}_rating::after {
                                    width: {{ $rating_progress }};
                                }
                            </style>
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
        {{ $all_reviews->links() }}
    </div>
</div>

<script>
    $(document).ready(function() {
        $('input#course-feedback-check-all').on('change', function() {
            $('input.course-feedback-item').prop('checked', $('input#course-feedback-check-all').prop('checked'));
        });

        $('#bulk-approve-action').on('click', function() {
            // Initialize an array to store the IDs of checked rows
            handleCourseFeedbacks('{{ route('student.review.approve') }}', true)
        });

        $('#bulk-unapprove-action').on('click', function() {
            // Initialize an array to store the IDs of checked rows
            handleCourseFeedbacks('{{ route('student.review.approve') }}', false)
        });

        $('#bulk-trash-action').on('click', function() {
            // Initialize an array to store the IDs of checked rows
            handleCourseFeedbacks('{{ route('student.review.trash') }}')
        });

        function handleCourseFeedbacks(url, is_approved) {
            var selectedRows = [];

            // Loop through all checkboxes with the class "row-checkbox"
            $('.course-feedback-item').each(function() {
                // Check if the current checkbox is checked
                if ($(this).is(':checked')) {
                    // Get the data-id attribute value, which represents the row ID or record ID
                    var rowId = $(this).data('id');
                    // Add the ID to the selectedRows array
                    selectedRows.push(rowId);
                }
            });

            $.ajax({
                type: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    review_ids: selectedRows,
                    is_approved: is_approved == false || is_approved == "false" ? 0 : 1,
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(jq, status, data) {
                    console.log('lesson complete - error: ' + data.toString());
                }
            })
        }
    })
</script>