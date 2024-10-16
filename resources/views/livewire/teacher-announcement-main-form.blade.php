<div>
    <!-- Overlay element -->
    <div id="overlay" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>

    <!--dialog-->
    <div id="announcement_dialog" class="fixed hidden z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-2/3 lg:w-1/2 xl:2/5 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg">
        <h1 class="text-2xl font-semibold">{{ __('Announcement') }}</h1>
        <div class="py-5">
            <form id="announcement_form" class="valid-form flex flex-wrap flex-row -mx-4" action="{{ route('teacher.announcement.store') }}" method="POST" enctype="multipart/form-data">
                @csrf    
                <!-- <input type="hidden" name="announcement_id" value="0" /> -->
                <button id="close_announcement_dialog" type="button" class="fill-current h-6 w-6 absolute right-0 top-0 m-4 text-3xl font-bold">×</button>
                <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                    <label for="announcement_name" class="inline-block mb-2">{{ __('Title') }} <span class="text-red-500">*</span></label>
                    <input id="announcement_name" name="title" type="text" class="w-full leading-5 relative py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" placeholder="" required>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                    <label for="announcement_description" class="inline-block mb-2">{{ __('Content') }}</label>
                    <textarea id="announcement_description" name="content" rows="8" class="w-full leading-5 relative py-2 px-4 rounded-lg text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0"></textarea>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 w-full md:w-1/2 mb-4">
                    <label for="start_date" class="inline-block mb-2">{{ __('Start Date') }} <span class="text-red-500">*</span></label>
                    <input id="start_date" name="start_date" type="date" class="w-full leading-5 relative py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" required>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 w-full md:w-1/2 mb-4">
                    <label for="end_date" class="inline-block mb-2">{{ __('End Date') }} <span class="text-red-500">*</span></label>
                    <input id="end_date" name="end_date" type="date" class="w-full leading-5 relative py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" required>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                    <label for="assign_course" class="inline-block mb-2">{{ __('Assign Course') }} <span class="text-red-500">*</span></label>
                    <div class="relative inline-block w-full">
                    <select id="assign_course" name="course_id" class="block w-full leading-5 py-2 pl-3 pr-10 rounded text-gray-800 bg-white border border-gray-300 focus:outline-none focus:border-gray-400 focus:ring-0 appearance-none" required>
                        <option value="" disabled selected>Select a course...</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 py-4 w-full mb-4 gap-4">
                    <div class="flex gap-4 mb-2">
                        <label for="attachment" class="inline-block" style="padding-top:15px;">Attachments</label>
                        <div class="w-full flex gap-4 items-center">
                            <!-- Button to add a file -->
                            <label for="attachment_file" class="flex items-center px-4 py-2 gap-3 rounded-xl bg-gray-600 border border-gray-300 border-dashed cursor-pointer">
                                <h4 class="text-base font-semibold text-white">Add file</h4>
                                <input type="file" id="attachment_file" name="attachment_file" hidden />
                            </label>
                            
                            <!-- Display the selected file name here -->
                            <span id="attachment_display" class="text-gray-800 bg-white border border-gray-300 rounded-lg px-4 py-2 hidden"></span>                        </div>
                    </div>
                </div>                
                <div class="form-group flex-shrink max-w-full px-4 w-full">
                    <x-button label="{{ __('Save') }}" type="submit" icon="" class="py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent" />
                </div>
            </form>
        </div>
    </div>

    <!-- <x-loading-spinner/> -->
    <div class="flex my-4 justify-end">
        <button id="open_announcement_dialog" class="bg-red-600 uppercase hover:bg-opacity-90 active:bg-opacity-70 text-white py-2 px-4 border-2 rounded-lg my-3">
            <i class="fa fa-plus" aria-hidden="true"></i>
            {{ __('Create new Announcement') }}
        </button>
    </div>
    <div class="overflow-x-scroll beautify-scrollbar text-center my-4 border rounded-2xl">
        <table class="w-full table-auto bg-white">
            <thead class="border-b-1 border-black">
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Announcement') }}</th>
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Course') }}</th>
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Created') }}</th>
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Action') }}</th>
            </thead>
            <tbody class="text-left">
            @if (!empty($announcements))
                @foreach($announcements as $announcement)
                    <tr class="border-t border-b-1 border-black" style="border-bottom:solid; border-bottom-width:1px;">
                        <td class="p-4 whitespace-nowrap text-left truncate">
                            <div class="flex">
                                <span class="block items-center gap-2 py-3 px-6 truncate">{{ $announcement['title'] }}</span>
                            </div>
                        </td>
                        <td class="p-4 whitespace-nowrap">{{ $announcement['course_title']}}</td>
                        <td class="p-4 whitespace-nowrap">{{ $announcement['start_date'] }}</td>
                        <td class="p-4 whitespace-nowrap">
                            <div class="flex" data-id="{{ $announcement['id'] }}" data-title="{{ $announcement['title'] }}" data-course-title="{{$announcement['course_title']}}" data-course-id="{{$announcement['course_id']}}" data-content="{{ $announcement['content'] }}" data-start-date="{{ $announcement['start_date'] }}" data-end-date="{{ $announcement['end_date'] }}">
                                <x-edit-icon-button class="edit_announcement_dialog_button" />
                                <x-remove-icon-button class="remove_announcement_button" />
                            </div>
                        </td>
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
   
</div>

<script>
    // handle the announcement Dialog
    $(document).ready(function() {

        $('body').on('click', '#open_announcement_dialog', function(event) {
            event.preventDefault();
            $('div#announcement_dialog').removeClass('hidden');
            $('div#overlay').removeClass('hidden');
            $('input[name=announcement_edit_flag]').val('new');
            $('input#announcement_name').val('');
            $('textarea#announcement_description').val('');
            $('select#video_source').val('');
            $('input#video_url').val('');
            $('input#attachment_display').val('');
        });

        $('body').on('click', '.edit_announcement_dialog_button', function(event) {
            event.preventDefault();
            $('div#announcement_dialog').removeClass('hidden');
            $('div#overlay').removeClass('hidden');
            const announcementObject = $(this).parent();
            const id = $(announcementObject).data('id');
            const title = $(announcementObject).data('title');
            const content = $(announcementObject).data('content');
            const startDate = $(announcementObject).data('start-date');
            const endDate = $(announcementObject).data('end-date');
            const courseId = $(announcementObject).data('course-id');
            const coursetitle = $(announcementObject).data('course-title');

            // Populate the form fields in the dialog
            $('#announcement_name').val(title);
            $('#announcement_description').val(content);
            $('#start_date').val(startDate);
            $('#end_date').val(endDate);
            $('#assign_course').val(courseId);

            // Set the form action to the update route
            const updateUrl = "{{ route('teacher.announcement.update', ':id') }}".replace(':id', id);
            $('#announcement_form').attr('action', updateUrl);
            console.log(updateUrl);

            // Set the form method to POST with _method to PUT
            $('#announcement_form').append('<input type="hidden" name="_method" value="PUT">');
            // Optional: If you want to clear the previous hidden _method input
            $('#announcement_form input[name="_method"]').remove();
            $('#announcement_form').append('<input type="hidden" name="_method" value="PUT">');

        });

        $('body').on('click', '.remove_announcement_button', function(event) {
            event.preventDefault();

            // Get the ID of the announcement to delete
            const announcementId = $(this).parent().data('id');
            console.log(announcementId);

            // Create a delete form dynamically
            const deleteForm = $('<form>', {
                'method': 'POST',
                'action': "{{ route('teacher.announcement.destroy', ':id') }}".replace(':id', announcementId),
                'style': 'display: none;'
            });

            // Add CSRF token
            deleteForm.append('@csrf');

            // Add DELETE method input
            deleteForm.append('<input name="_method" type="hidden" value="DELETE">');

            // Append the form to the body
            $('body').append(deleteForm);

            // Submit the form
            deleteForm.submit();
        });


        $('button#close_announcement_dialog').on('click', function() {
            closeDialog();
        });

        $('#attachment_file').on('change', function() {
            const file = this.files[0];  // Get the selected file
            const displayElement = $('#attachment_display');
            
            if (file) {
                // Display the file name and make the span visible
                displayElement.text(file.name).removeClass('hidden');
            } else {
                // Clear the file name if no file is selected
                displayElement.text('').addClass('hidden');
            }
        });



        $('div#overlay').on('click', function() {
            closeDialog();
        });

        function closeDialog() {
            $('div#announcement_dialog').addClass('hidden');
            $('div#overlay').addClass('hidden');
        }

        const courseValidation = function () {
            const announcementForm = document.getElementById('announcement_form');
            const pristine = new Pristine(announcementForm);
            announcementForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const valid = pristine.validate();

                if ($('input#announcement_title').val() == '') {
                    toastr.error('The title is required.');
                    return false;
                }
                else if ($('input#start_date').val() == '') {
                    toastr.error('The start date is required.');
                    return false;
                }
                else if ($('input#end_date').val() == '') {
                    toastr.error('The end date is required.');
                    return false;
                }
                else if (isNaN($('input#assign_course').val())) {
                    toastr.error('The assign course is requied.');
                    return false;
                }
                
                else {
                    announcementForm.submit();
                    return true;
                }
            });
        }
    });

</script>
