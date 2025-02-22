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
                <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Enrolled') }}</th>
                <th class="capitalize p-4 whitespace-nowrap text-center">{{ __('Action') }}</th>
            </thead>
            <tbody class="">
                @if ($students->isNotEmpty())
                    @foreach($students as $student)
                        <tr class="border-t">
                            <td class="p-4 whitespace-nowrap text-left">
                                <div class="flex">
                                    <img width="50" height="50" class="rounded-full" src="{{ $student->profile_photo_path }}" onerror="this.src='{{ asset('images/logo/avatar.png') }}'" />
                                    <a href="{{ route('students.show', $student->id) }}" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 text-purple-500">{{ $student->name }}</a>
                                </div>

                            </td>
                            <td class="p-4 whitespace-nowrap">{{ date('m-d-Y', strtotime($student->created_at)) }}</td>
                            <td class="p-4 whitespace-nowrap flex justify-center">
                                <form action="{{ route('user.lock-account', $student) }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="lock" value="{{ ! $student->locked }}" />
                                    <button type="submit" class="{{ $student->locked ? 'bg-orange-400' : 'bg-red-500' }} px-3 py-1 text-white rounded mr-2">{{ $student->locked ? __('Activate') : __('Suspend') }}</button>
                                </form>
                                <form id="user_delete_form" action="{{ route('user.destroy', $student) }}" method="POST">
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
        {{ $students->links() }}
    </div>
</div>
