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
                                <label for="course_title" class="block mb-2 font-medium text-gray-900">{{ 'Course Title' }}</label>
                                <input type="text" id="course_title" minlength="3" maxlength="255" required class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required>
                            </div>
                            <div class="mb-6">
                                <label for="course_price" class="block mb-2 font-medium text-gray-900">{{ 'Pricing' }} ($)</label>
                                <input type="number" id="course_price" minlength="1" maxlength="10" required class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required>
                            </div>
                            <div class="mb-6">
                                <label for="course_description" class="inline-block mb-2">Description</label>
                                <textarea id="course_description" rows="8" class="course_description w-full leading-5 relative py-3 px-5 rounded-lg text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600" id="texteditor" rows="3"></textarea>
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

            <div class="w-full ps-4 pb-4 lg:px-4 xl:w-2/3 2xl:w-3/4">
                <div class="card mt-2">
                    <div class="card-header mb-7">
                        <h3 class="text-xl md:text-2xl font-bold">
                            {{ __('Course Content Builder') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-6">
                            <label for="course_title" class="block mb-2 font-medium text-gray-900">{{ 'Course Title' }}</label>
                            <input type="text" id="course_title" minlength="3" maxlength="255" required class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required>
                        </div>
                        <div class="mb-6">
                            <label for="course_price" class="block mb-2 font-medium text-gray-900">{{ 'Pricing' }} ($)</label>
                            <input type="number" id="course_price" minlength="1" maxlength="10" required class="shadow-sm border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required>
                        </div>
                        <div class="mb-6">
                            <label for="course_description" class="inline-block mb-2">Description</label>
                            <textarea id="course_description" rows="8" class="course_description w-full leading-5 relative py-3 px-5 rounded-lg text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600" id="texteditor" rows="3"></textarea>
                        </div>

                        <x-button label="{{ __('Add new Topic') }}" icon="fas fa-plus" class="py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent" />
                        <x-light-button label="{{ __('Create quiz') }}" icon="fas fa-plus" class="py-3 md:px-10 bg-white text-black font-semibold border border-red-300" />
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
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
</div>


