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
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Status') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Courses') }}</th>
            <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Enrolled') }}</th>
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
                        <td class="p-4 whitespace-nowrap">
                            @if ($teacher->locked)
                                <span class="inline-block leading-none text-center py-1 px-2 bg-red-500 text-gray-100 font-bold rounded" style="font-size: .75em;">{{ __('Suspend') }}</span>
                            @else
                                <span class="inline-block leading-none text-center py-1 px-2 bg-green-500 text-gray-100 font-bold rounded" style="font-size: .75em;">{{ __('Active') }}</span>
                            @endif
                        </td>
                        <td class="p-4 whitespace-nowrap">{{ $this->getAssignedCourses($teacher) }}</td>
                        <td class="p-4 whitespace-nowrap">{{ date('m-d-Y', strtotime($teacher->created_at)) }}</td>
                        <td class="p-4 whitespace-nowrap flex justify-center">
                            <form action="{{ route('user.lock-account', $teacher) }}" method="POST">
                                @csrf
                                @method('post')
                                <input type="hidden" name="lock" value="{{ ! $teacher->locked }}" />
                                <button type="submit" class="{{ $teacher->locked ? 'bg-orange-400' : 'bg-red-500' }} px-3 py-1 text-white rounded mr-2">{{ $teacher->locked ? __('Activate') : __('Suspend') }}</button>
                            </form>
                            <form id="user_delete_form" action="{{ route('user.destroy', $teacher) }}" method="POST">
                                <button id="delete_user_button" class="bg-red-500 px-3 py-1 text-white rounded">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @method('delete')
                                @csrf
                            </form>
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
    $(document).ready(function() {
        $('button#delete_user_button').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                html: `Are you sure you want to delete the user?`,
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: `Yes, delete!`,
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "py-2 px-4 inline-block text-center mb-3 rounded leading-5 text-gray-100 bg-green-500 border border-green-500 hover:text-white hover:bg-green-600 hover:ring-0 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:outline-none focus:ring-0",
                    cancelButton: "ml-3 py-2 px-4 inline-block text-center mb-3 rounded leading-5 text-gray-800 bg-gray-100 border border-gray-100 hover:text-gray-900 hover:bg-gray-200 hover:ring-0 hover:border-gray-200 focus:bg-gray-200 focus:border-gray-200 focus:outline-none focus:ring-0"
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $('form#user_delete_form').submit();
                }
            })
        })
    })
</script>
