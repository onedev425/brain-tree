<div class="flex flex-col bg-white mb-12 md:mb-0 rounded-2xl border">
    <div class="relative border-b">
        <a href="{{ route('teacher.course.edit', $course_id) }}">
            <div class="absolute inset-0 hover:bg-white opacity-0 transition duration-700 hover:opacity-10"></div>
            <img class="w-full h-48 object-cover" src="{{ $image }}" alt="alt title">
        </a>
    </div>
    <div class="p-4 flex-1">
        <div class="mb-2">
            <span class="text-xs">{{ substr($created_at, 0, 10) }}</span>
        </div>
        <div class="">
            <h3 class="text-lg leading-normal mb-3 font-bold text-gray-800">
                <a href="{{ route('teacher.course.edit', $course_id) }}" class="hover:text-indigo-700">{{ $title }}</a>
            </h3>
            <div class="flex text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="14.997" height="15" viewBox="0 0 14.997 15">
                    <g id="Icon_ionic-ios-timer" data-name="Icon ionic-ios-timer" transform="translate(-3.938 -3.938)">
                        <path id="Path_23" data-name="Path 23" d="M11.438,18.938a7.5,7.5,0,0,1-5.205-12.9.6.6,0,1,1,.836.866,6.294,6.294,0,1,0,4.969-1.733V7.519a.6.6,0,0,1-1.208,0V4.541a.6.6,0,0,1,.6-.6,7.5,7.5,0,0,1,0,15Z" transform="translate(0 0)" fill="#6c6c6c"/>
                        <path id="Path_24" data-name="Path 24" d="M11.847,11.322,15.579,14a1.129,1.129,0,1,1-1.313,1.838A1.09,1.09,0,0,1,14,15.578l-2.681-3.731a.376.376,0,0,1,.525-.525Z" transform="translate(-3.413 -3.413)" fill="#6c6c6c"/>
                    </g>
                </svg>
                <span class="ml-2 text-xs">{{ $duration }}</span>
            </div>
        </div>
    </div>
    <div class="border-t pl-4 py-2">
        <div class="flex flex-row justify-between">
            <div class="flex flex-col">
                <h3 class="text-base">{{ __('Price') }}: ${{ $price }}</h3>
            </div>
            <div class="flex">
                <a href="{{ route('teacher.course.edit', $course_id) }}" class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.906" height="18.906" viewBox="0 0 18.906 18.906">
                        <g id="Icon_feather-edit" data-name="Icon feather-edit" transform="translate(-2 -1.818)">
                            <path id="Path_56" data-name="Path 56" d="M10.562,6H4.68A1.68,1.68,0,0,0,3,7.68V19.443a1.68,1.68,0,0,0,1.68,1.68H16.443a1.68,1.68,0,0,0,1.68-1.68V13.562" transform="translate(0 -1.4)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            <path id="Path_57" data-name="Path 57" d="M20.822,3.34a1.782,1.782,0,1,1,2.521,2.521l-7.982,7.982L12,14.683l.84-3.361Z" transform="translate(-3.959)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </g>
                    </svg>
                </a>
                <div x-data="{ open: false }" class="relative mr-4">
                    <button @click="open = ! open" class="text-gray-500 hover:text-gray-600 dark:hover:text-gray-400 transition-colors duration-200 focus:outline-none hover:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="18" viewBox="0 0 4 18">
                            <g id="Group_281" data-name="Group 281" transform="translate(-953 -528)">
                                <g id="Ellipse_43" data-name="Ellipse 43" transform="translate(953 528)" stroke="#111" stroke-width="1">
                                    <circle cx="2" cy="2" r="2" stroke="none"/>
                                    <circle cx="2" cy="2" r="1.5" fill="none"/>
                                </g>
                                <g id="Ellipse_44" data-name="Ellipse 44" transform="translate(953 535)" stroke="#111" stroke-width="1">
                                    <circle cx="2" cy="2" r="2" stroke="none"/>
                                    <circle cx="2" cy="2" r="1.5" fill="none"/>
                                </g>
                                <g id="Ellipse_45" data-name="Ellipse 45" transform="translate(953 542)" stroke="#111" stroke-width="1">
                                    <circle cx="2" cy="2" r="2" stroke="none"/>
                                    <circle cx="2" cy="2" r="1.5" fill="none"/>
                                </g>
                            </g>
                        </svg>

                    </button>
                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute rounded-xl bg-white py-2 px-3 z-10" style="min-width: 10rem; display: none; right:0; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 50px -6px rgb(0 0 0 / 0.1);">
                        @if (auth()->user()->hasRole('super-admin'))
                            <form action="{{ route('teacher.course.publish', $course_id) }}" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="is_published" value="{{ $is_published }}">
                                <button type="submit" id="publish_course_button" class="w-full text-left block rounded-lg px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 ">{{ $is_published == 1 ? __('Unpublish') : __('Publish') }}</button>
                            </form>
                        @endif
                        <form action="{{ route('teacher.course.destroy', $course_id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="is_published" value="{{ $is_published }}">
                            <button type="submit" id="delete_course_button" class="w-full text-left block rounded-lg px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 ">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div><!-- end card -->

<script>
    $(document).ready(function() {
        $('button#publish_course_button').on('click', function(event) {
            event.preventDefault();
            const form = $(this).parent();
            const published = $('input[name=is_published]').val() == 1 ? 'Unpublish' : 'Publish';
            Swal.fire({
                html: `Are you sure you want to ${published.toLowerCase()} the course?`,
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: `Yes, ${published}!`,
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "py-2 px-4 inline-block text-center mb-3 rounded leading-5 text-gray-100 bg-green-500 border border-green-500 hover:text-white hover:bg-green-600 hover:ring-0 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:outline-none focus:ring-0",
                    cancelButton: "ml-3 py-2 px-4 inline-block text-center mb-3 rounded leading-5 text-gray-800 bg-gray-100 border border-gray-100 hover:text-gray-900 hover:bg-gray-200 hover:ring-0 hover:border-gray-200 focus:bg-gray-200 focus:border-gray-200 focus:outline-none focus:ring-0"
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $(form).submit();
                }
            })
        })

        $('button#delete_course_button').on('click', function(event) {
            event.preventDefault();
            const form = $(this).parent();
            Swal.fire({
                html: "Are you sure you want to delete the course?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "py-2 px-4 inline-block text-center mb-3 rounded leading-5 text-gray-100 bg-red-500 border border-red-500 hover:text-white hover:bg-red-600 hover:ring-0 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:outline-none focus:ring-0",
                    cancelButton: "ml-3 py-2 px-4 inline-block text-center mb-3 rounded leading-5 text-gray-800 bg-gray-100 border border-gray-100 hover:text-gray-900 hover:bg-gray-200 hover:ring-0 hover:border-gray-200 focus:bg-gray-200 focus:border-gray-200 focus:outline-none focus:ring-0"
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $(form).submit();
                }
            })
        })
    });
</script>
