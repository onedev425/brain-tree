<div>
    <div class="block">
        <form>
            <div class="float-right my-3">
                <button type="button" class="py-3 px-11 inline-block text-center mb-3 rounded-lg leading-5 text-gray-500 bg-white border border-gray-300 hover:text-dark hover:bg-gray-200 hover:ring-0 hover:border-gray-500 focus:text-dark focus:bg-gray-200 focus:border-gray-500 focus:outline-none focus:ring-0 mr-4">
                    {{ __('Save') }}
                </button>

                <button type="button" class="py-3 px-8 inline-block text-center mb-3 rounded-lg leading-5 text-gray-100 bg-red-500 border border-red-500 hover:text-white hover:bg-red-600 hover:ring-0 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:outline-none focus:ring-0">
                    {{ __('Publish') }}
                </button>
            </div>

            <!-- begin::Course Basic info -->
            <div class="w-full flex flex-col-reverse xl:flex-row">

                <div class="w-full ps-4 pb-4 lg:px-4 xl:w-2/3 2xl:w-3/4">
                    <div class="card mt-2">
                        <div class="card-header mb-7">
                            <h3 class="text-xl md:text-2xl font-bold">
                                {{ __('Course Basic Info') }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-6">
                                <label for="course_title" class="block mb-2 font-medium text-gray-900">{{ __('Course Title') }}</label>
                                <input type="text" id="course_title" minlength="3" maxlength="255" required class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required>
                            </div>
                            <div class="mb-6">
                                <label for="course_price" class="block mb-2 font-medium text-gray-900">{{ __('Pricing') }} ($)</label>
                                <input type="number" id="course_price" minlength="1" maxlength="10" required class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required>
                            </div>
                            <div class="mb-6">
                                <label for="course_description" class="inline-block mb-2">{{ __('Description') }}</label>
                                <textarea id="course_description" rows="8" class="course_description w-full leading-5 relative py-3 px-5 rounded-lg text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" id="texteditor" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ps-4 pb-4 min-w-96 lg:block xl:w-1/3 2xl:w-1/4" style="min-width: 400px">
                    <div class="card mt-2">
                        <div class="card-header mb-7">
                            <h3 class="text-xl md:text-2xl font-bold">
                                {{ __('Featured Image') }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-7">
                                <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true" style="background-image: url( {{ asset('images/logo/course.jpg') }} )">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-72 h-52" id="course_image_container" style="background-image: url( {{ asset('images/logo/course.jpg') }} )"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon rounded-full hover:text-green-600 w-6 h-6 bg-white shadow" data-kt-image-input-action="change" title="Change company logo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                        <!--begin::Inputs-->
                                        <input type="file" name="course_image" id="course_image_input" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="course_image_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon rounded-full hover:text-green-600 w-6 h-6 bg-white shadow" data-kt-image-input-action="cancel" title="Cancel company logo">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                        </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon rounded-full hover:text-green-600 w-6 h-6 bg-white shadow" id="course_image_remove" data-kt-image-input-action="remove" title="Remove company logo">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                        </span>
                                    <!--end::Remove-->
                                </div>
                                <div class="form-text">Allowed file types: png, jpg, jpeg.<br/>Max Size: 5MB, 1000 x 1000</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end::Course Basic Info -->

            <!-- begin::Course Content Builder -->
            <div class="w-full flex flex-col-reverse xl:flex-row">
                <div class="w-full ps-4 pb-4 lg:px-4 xl:w-2/3 2xl:w-3/4">
                    <div class="card mt-2">
                        <div class="card-header mb-7">
                            <h3 class="text-xl md:text-2xl font-bold">
                                {{ __('Course Content Builder') }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="topic_list" x-data="{selected:0}">
                                <div class="relative flex flex-wrap flex-col shadow mb-4 bg-white">
                                    <div class="border-b border-gray-200 mb-0 bg-gray-100 py-2 px-4">
                                        <div class="d-grid mb-0">
                                            <a href="javascript:;" class="py-1 px-0 w-full rounded leading-5 font-medium flex justify-between focus:outline-none focus:ring-0"  @click="selected !== 0 ? selected = 0 : selected = null">
                                                <div class="flex mt-2.5">
                                                    <span class="mr-3">
                                                        <svg class="transform transition duration-500" :class="{ '-rotate-180': selected == 0 }" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                    <span id="topic_name_label">How is the SEO services system at Taidash?</span>
                                                </div>
                                                <div class="flex">
                                                    <x-edit-icon-button class=""/>
                                                    <x-remove-icon-button class=""/>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div x-show="selected == 0">
                                        <div class="flex-1 py-4 px-7">
                                            <x-light-button label="{{ __('Add New Lesson') }}" icon="" class="open_lesson_dialog_button flex py-3 md:px-10 bg-white text-sm text-black font-semibold border border-red-300" >
                                                <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="20.376" height="18.538" viewBox="0 0 20.376 18.538">
                                                    <g id="Icon_feather-book-open" data-name="Icon feather-book-open" transform="translate(-2 -3.5)">
                                                        <path id="Path_64" data-name="Path 64" d="M3,4.5H8.513a3.675,3.675,0,0,1,3.675,3.675V21.038a2.756,2.756,0,0,0-2.756-2.756H3Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                                        <path id="Path_65" data-name="Path 65" d="M27.188,4.5H21.675A3.675,3.675,0,0,0,18,8.175V21.038a2.756,2.756,0,0,1,2.756-2.756h6.431Z" transform="translate(-5.812)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                                    </g>
                                                </svg>
                                            </x-light-button>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative flex flex-wrap flex-col shadow mb-4 bg-white">
                                    <div class="border-b border-gray-200 mb-0 bg-gray-100 py-2 px-4">
                                        <div class="d-grid mb-0">
                                            <a href="javascript:;" class="py-1 px-0 w-full rounded leading-5 font-medium flex justify-between focus:outline-none focus:ring-0" @click="selected !== 1 ? selected = 1 : selected = null">
                                                <div class="flex mt-2.5">
                                                    <span class="mr-3">
                                                        <svg class="transform transition duration-500" :class="{ '-rotate-180': selected == 1 }" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                          <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                    How many keywords are optimized?
                                                </div>
                                                <div class="flex">
                                                    <x-edit-icon-button class=""/>
                                                    <x-remove-icon-button class=""/>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div x-show="selected == 1">
                                        <div class="flex pt-4 px-7 justify-between">
                                            <div class="pt-1.5">What Are The Principles Of Effective Web Design?</div>
                                            <div class="min-w-fit" >
                                                <x-edit-icon-button class=""/>
                                                <x-remove-icon-button class=""/>
                                            </div>
                                        </div>
                                        <div class="flex pt-4 px-7 justify-between">
                                            <div class="pt-1.5">How Do You Ensure That A Website Is Mobile-Friendly?</div>
                                            <div class="min-w-fit" >
                                                <x-edit-icon-button class=""/>
                                                <x-remove-icon-button class=""/>
                                            </div>
                                        </div>
                                        <div class="flex pt-4 px-7 justify-between">
                                            <div class="pt-1.5">What Are Some Common Mistakes To Avoid In Web Design?</div>
                                            <div class="min-w-fit" >
                                                <x-edit-icon-button class=""/>
                                                <x-remove-icon-button class=""/>
                                            </div>
                                        </div>
                                        <div class="flex-1 py-4 px-7">
                                            <x-light-button label="{{ __('Add New Lesson') }}" icon="" class="open_lesson_dialog_button flex py-3 md:px-10 bg-white text-sm text-black font-semibold border border-red-300" >
                                                <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="20.376" height="18.538" viewBox="0 0 20.376 18.538">
                                                    <g id="Icon_feather-book-open" data-name="Icon feather-book-open" transform="translate(-2 -3.5)">
                                                        <path id="Path_64" data-name="Path 64" d="M3,4.5H8.513a3.675,3.675,0,0,1,3.675,3.675V21.038a2.756,2.756,0,0,0-2.756-2.756H3Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                                        <path id="Path_65" data-name="Path 65" d="M27.188,4.5H21.675A3.675,3.675,0,0,0,18,8.175V21.038a2.756,2.756,0,0,1,2.756-2.756h6.431Z" transform="translate(-5.812)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                                    </g>
                                                </svg>
                                            </x-light-button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <x-button id="open_topic_dialog_button" label="{{ __('Add new Topic') }}" icon="fas fa-plus" class="py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent" />
                            <x-light-button id="open_quiz_dialog_button" label="{{ __('Create quiz') }}" icon="fas fa-plus" class="py-3 md:px-10 bg-white text-black font-semibold border border-red-300" />
                        </div>
                    </div>
                </div>
                <div class="ps-4 pb-4 min-w-96 lg:block xl:w-1/3 2xl:w-1/4" style="min-width: 400px"></div>
            </div>
            <!-- end::Course Content Builder -->

            <!-- begin::Course Quiz -->
            <div class="w-full flex flex-col-reverse xl:flex-row">
                <div class="w-full ps-4 pb-4 lg:px-4 xl:w-2/3 2xl:w-3/4">
                    <div class="card mt-2">
                        <div class="card-header mb-7">
                            <h3 class="text-xl md:text-2xl font-bold">
                                {{ __('Quizzes') }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="flex pt-4 justify-between">
                                <div class="pt-1.5">What Are The Principles Of Effective Web Design?</div>
                                <div class="min-w-fit" >
                                    <x-edit-icon-button class=""/>
                                    <x-remove-icon-button class=""/>
                                </div>
                            </div>
                            <div class="flex pt-4 justify-between">
                                <div class="pt-1.5">How Do You Ensure That A Website Is Mobile-Friendly?</div>
                                <div class="min-w-fit" >
                                    <x-edit-icon-button class=""/>
                                    <x-remove-icon-button class=""/>
                                </div>
                            </div>
                            <div class="flex pt-4 justify-between">
                                <div class="pt-1.5">What Are Some Common Mistakes To Avoid In Web Design?</div>
                                <div class="min-w-fit" >
                                    <x-edit-icon-button class=""/>
                                    <x-remove-icon-button class=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-4 pb-4 min-w-96 lg:block xl:w-1/3 2xl:w-1/4" style="min-width: 400px"></div>
            </div>
            <!-- end::Course Quiz -->
        </form>
    </div>


    <!-- Overlay element -->
    <div id="overlay" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>

    <!-- Topic dialog -->
    <div id="topic_dialog" class="hidden fixed z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-2/3 lg:w-1/2 xl:2/5 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg">
        <h1 class="text-2xl font-semibold">{{ __('Topic') }}</h1>
        <div class="py-5">
            <form id="topic_form" class="valid-form flex flex-wrap flex-row -mx-4">
                <input type="hidden" name="topic_edit_flag" value="new" />
                <button id="close_topic_dialog" type="button" class="fill-current h-6 w-6 absolute right-0 top-0 m-4 text-3xl font-bold">×</button>
                <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                    <label for="topic_name" class="inline-block mb-2">{{ __('Topic Name') }}</label>
                    <input id="topic_name" type="text" class="w-full leading-5 relative py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" placeholder="" required>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                    <label for="topic_summary" class="inline-block mb-2">{{ __('Topic Summary') }}</label>
                    <textarea id="topic_summary" rows="8" class="w-full leading-5 relative py-2 px-4 rounded-lg text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" ></textarea>
                </div>

                <div class="form-group flex-shrink max-w-full px-4 w-full">
                    <x-button label="{{ __('Save') }}" type="submit" id="save_topic_button" icon="" class="py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent" />
                </div>
            </form>
        </div>
    </div>

    <!-- Lesson dialog -->
    <div id="lesson_dialog" class="hidden fixed z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-2/3 lg:w-1/2 xl:2/5 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg">
        <h1 class="text-2xl font-semibold">{{ __('Lesson') }}</h1>
        <div class="py-5">
            <form class="valid-form flex flex-wrap flex-row -mx-4">
                <button id="close_lesson_dialog" type="button" class="fill-current h-6 w-6 absolute right-0 top-0 m-4 text-3xl font-bold">×</button>
                <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                    <label for="lesson_name" class="inline-block mb-2">{{ __('Lesson Name') }}</label>
                    <input id="lesson_name" type="text" class="w-full leading-5 relative py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" placeholder="" required>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                    <label for="lesson_description" class="inline-block mb-2">{{ __('Lesson Content') }}</label>
                    <textarea id="lesson_description" rows="8" class="w-full leading-5 relative py-2 px-4 rounded-lg text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" id="texteditor"></textarea>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 w-full md:w-1/2 mb-4">
                    <label for="video_source" class="inline-block mb-2">{{ __('Video Source') }}</label>
                    <select id="video_source" class="inline-block w-full leading-5 relative py-2 pl-3 pr-8 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 select-caret appearance-none" required>
                        <option value="">{{ __('Choose...') }}</option>
                        <option value="youtube">{{ __('Youtube') }}</option>
                        <option value="vimeo">{{ __('Vimeo') }}</option>
                    </select>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 w-full md:w-1/2 mb-4">
                    <label for="video_url" class="inline-block mb-2">{{ __('Video URL') }}</label>
                    <input id="video_url" type="text" class="w-full leading-5 relative py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" required>
                </div>

                <div class="form-group flex-shrink max-w-full px-4 w-full">
                    <x-button label="{{ __('Save') }}" type="submit" icon="" class="py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent" />
                </div>
            </form>
        </div>
    </div>

    <!-- Quiz dialog -->
    <div id="quiz_dialog" class="hidden fixed z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-2/3 lg:w-1/2 xl:2/5 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg">
        <h1 class="text-2xl font-semibold">{{ __('Quiz') }}</h1>
        <div class="py-5">
            <form class="valid-form flex flex-wrap flex-row -mx-4">
                <button id="close_quiz_dialog" type="button" class="fill-current h-6 w-6 absolute right-0 top-0 m-4 text-3xl font-bold">×</button>
                <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                    <label for="quiz_title" class="inline-block mb-2">{{ __('Write your question here') }}</label>
                    <input id="quiz_title" type="text" class="w-full leading-5 relative py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" placeholder="" required>
                </div>
                <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                    <label for="quiz_description" class="inline-block mb-2">{{ __('Description') }} ({{ __('Optional') }})</label>
                    <textarea id="quiz_description" rows="8" class="w-full leading-5 relative py-2 px-4 rounded-lg text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" ></textarea>
                </div>

                <div class="form-group flex-shrink max-w-full px-4 w-full">
                    <x-button label="{{ __('Save') }}" type="submit" icon="" class="py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent" />
                </div>
            </form>
        </div>
    </div>

    <input name="add_new_lesson_label" value="{{ __('Add New Lesson') }}" />

    <script>
        // handle the image uploading
        const imageInput = document.getElementById('course_image_input');
        const imageContainer = document.getElementById('course_image_container');
        const imageRemove = document.getElementById('course_image_remove');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imageData = e.target.result;
                    imageContainer.style.backgroundImage = `url(${imageData})`;
                };

                reader.readAsDataURL(file);
                imageContainer.parentNode.classList.remove('image-input-empty');
            }
        });

        imageRemove.addEventListener('click', function() {
            imageContainer.style.backgroundImage = 'none';
            imageContainer.parentNode.classList.add('image-input-empty');
        });
    </script>

    <script>
        // handle the Topic Dialog
        $(document).ready(function() {
            $('body').on('click', '#open_topic_dialog_button', function(event) {
                event.preventDefault();
                $('div#topic_dialog').removeClass('hidden');
                $('div#overlay').removeClass('hidden');
                $('input#topic_name').val('');
                $('textarea#topic_summary').val('');
                $('input[name=topic_edit_flag]').val('new');
            });

            $('body').on('click', '.edit_topic_dialog_button', function(event) {
                event.preventDefault();
                $('div#topic_dialog').removeClass('hidden');
                $('div#overlay').removeClass('hidden');

                const topicObject = $(this).parent().prev();
                $('input#topic_name').val($(topicObject).find('span.topic_info').html());
                $('textarea#topic_summary').val($(topicObject).find('span.topic_info').attr('data-summary'));
                $('input[name=topic_edit_flag]').val($(topicObject).find('span.topic_info').data('uuid'));
            });

            $('body').on('click', '.remove_topic_button', function(event) {
                event.preventDefault();
                const topicRootObject = $(this).parent().parent().parent().parent().parent();
                $(topicRootObject).remove();
            });

            $('button#close_topic_dialog').on('click', function() {
                closeTopicDialog();
            });

            $('div#overlay').on('click', function() {
                closeTopicDialog();
            });
        });

        // hide the overlay and the dialog
        function closeTopicDialog() {
            $('div#topic_dialog').addClass('hidden');
            $('div#overlay').addClass('hidden');
        };
    </script>

    <script>
        // handle the Lesson Dialog
        $(document).ready(function() {
            $('body').on('click', '.open_lesson_dialog_button', function(event) {
                event.preventDefault();
                $('div#lesson_dialog').removeClass('hidden');
                $('div#overlay').removeClass('hidden');
            });

            $('body').on('click', '.edit_lesson_dialog_button', function(event) {
                event.preventDefault();
                $('div#lesson_dialog').removeClass('hidden');
                $('div#overlay').removeClass('hidden');
            });

            $('button#close_lesson_dialog').on('click', function() {
                closeLessonDialog();
            });

            $('div#overlay').on('click', function() {
                closeLessonDialog();
            });
        });

        // hide the overlay and the dialog
        function closeLessonDialog() {
            $('div#lesson_dialog').addClass('hidden');
            $('div#overlay').addClass('hidden');
        };
    </script>

    <script>
        // handle the Quiz Dialog
        var openQuizDialogButton = document.getElementById('open_quiz_dialog_button');
        var quizDialog = document.getElementById('quiz_dialog');
        var closeButton = document.getElementById('close_quiz_dialog');
        var overlay = document.getElementById('overlay');

        var openQuizDialog = function(event) {
            event.preventDefault();
            quizDialog.classList.remove('hidden');
            overlay.classList.remove('hidden');
        };

        // hide the overlay and the dialog
        var closeQuizDialog = function () {
            quizDialog.classList.add('hidden');
            overlay.classList.add('hidden');
        };

        openQuizDialogButton.addEventListener('click', openQuizDialog);
        closeButton.addEventListener('click', closeQuizDialog);
        overlay.addEventListener('click', closeQuizDialog);
    </script>

    <script>
        const myValidation = function () {
            var topicForm = document.getElementById('topic_form');
            var pristine = new Pristine(topicForm);

            topicForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                const valid = pristine.validate();

                if (valid) {

                    const topicName = $('input#topic_name').val();
                    const topicSummary = $('textarea#topic_summary').val();

                    if ($('input[name=topic_edit_flag]').val() == 'new') {
                        const uuid = generateUUID();
                        const newTopic = `
                            <div class="border-b border-gray-200 mb-0 bg-gray-100 py-2 px-4">
                                <div class="d-grid mb-0">
                                    <a href="javascript:;" class="py-1 px-0 w-full rounded leading-5 font-medium flex justify-between focus:outline-none focus:ring-0" @click="selected !== '${uuid}' ? selected = '${uuid}' : selected = null">
                                        <div class="flex mt-2.5">
                                            <span class="mr-3">
                                                <svg class="transform transition duration-500 -rotate-180" :class="{ '-rotate-180': selected == '${uuid}' }" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                            <span class="topic_info" data-uuid="${uuid}" data-summary="${topicSummary}">${topicName}</span>
                                        </div>
                                        <div class="flex">
                                            <x-edit-icon-button class="edit_topic_dialog_button" />
                                            <x-remove-icon-button class="remove_topic_button" />
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div x-show="selected == '${uuid}'">
                                <div class="flex-1 py-4 px-7">
                                    <button type="button" class="open_lesson_dialog_button flex py-3 md:px-10 bg-white text-sm text-black font-semibold border border-red-300 uppercase inline-block py-2 px-4 border-2 rounded-lg my-3 hover:bg-gray-50" icon="">
                                        <i class="" aria-hidden="true"></i>
                                        <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="20.376" height="18.538" viewBox="0 0 20.376 18.538">
                                            <g id="Icon_feather-book-open" data-name="Icon feather-book-open" transform="translate(-2 -3.5)">
                                                <path id="Path_64" data-name="Path 64" d="M3,4.5H8.513a3.675,3.675,0,0,1,3.675,3.675V21.038a2.756,2.756,0,0,0-2.756-2.756H3Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                                <path id="Path_65" data-name="Path 65" d="M27.188,4.5H21.675A3.675,3.675,0,0,0,18,8.175V21.038a2.756,2.756,0,0,1,2.756-2.756h6.431Z" transform="translate(-5.812)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                            </g>
                                        </svg> ` + $('input[name=add_new_lesson_label]').val() + `
                                    </button>
                                </div>
                            </div>
                        `;

                        var container = document.createElement('div');
                        container.innerHTML = newTopic;
                        container.classList.add('relative', 'flex', 'flex-wrap', 'flex-col', 'shadow', 'mb-4', 'bg-white');
                        document.getElementById('topic_list').appendChild(container);
                    }
                    else {
                        const uuid = $('input[name=topic_edit_flag]').val();
                        const topicObject = $('span[data-uuid="' + uuid + '"]');
                        $(topicObject).html(topicName);
                        $(topicObject).attr('data-summary', topicSummary);
                    }


                    closeTopicDialog();
                }

            });
        };

        window.addEventListener("load", () => {
            myValidation();
        });

    </script>
    <script>
        function generateUUID() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0,
                    v = c === 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }
    </script>
</div>


