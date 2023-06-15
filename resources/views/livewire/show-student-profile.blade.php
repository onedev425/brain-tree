<div>
    <livewire:show-user-profile :user="$student" />

    <div class="card float-left w-full mt-0">
        <div class="card-body">
            <div class="block md:flex mt-4 md:mt-10 border-b-2 border-gray-300">
                <a href="javascript:;" wire:click="setTab('progress')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'progress' ? 'border-b-4 border-green-600' : '' }}" style="{{ $activeTab === 'progress' ? '' : 'opacity: .5' }}">
                    {{ __('In Progress') }} ( {{ count($progress_courses) }} )
                </a>
                <a href="javascript:;" wire:click="setTab('completed')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/4 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'completed' ? 'border-b-4 border-green-600' : '' }}"  style="{{ $activeTab === 'completed' ? '' : 'opacity: .5' }}">
                    {{ __('Completed') }} ( {{ count($completed_courses) }} )
                </a>
            </div>

            <div class="mt-8 lg:mt-0 lg:grid lg:gap-4 lg:grid-cols-2 lg:p-4 xl:grid-cols-3 xl:gap-4 xl:p-8 2xl:grid-cols-4 2xl:gap-8">
                @if ($activeTab === 'progress')
                    @foreach($progress_courses as $course)
                        @livewire('show-student-course-block', [
                            'title' => $course->title,
                            'image' => $course->image,
                            'created_at' => $course->created_at,
                            'lesson_nums' => count($course->lessons),
                            'quiz_nums' => count($course->questions),
                            'progress' => $this->getStudentCourseProgressPercent($course, $student)
                        ])
                    @endforeach
                @else
                    @foreach($completed_courses as $course)
                        @livewire('show-student-course-block', [
                            'title' => $course->title,
                            'image' => $course->image,
                            'created_at' => $course->created_at,
                            'lesson_nums' => count($course->lessons),
                            'quiz_nums' => count($course->questions),
                            'progress' =>  $this->getStudentCourseProgressPercent($course, $student)
                        ])
                    @endforeach
                @endif
            </div>
        </div>

    </div>

    <div class="card float-left w-full mt-2">
        <div class="card-body">
            <h3 class="text text-2xl m-2 font-bold">Marks</h3>
            <div class="overflow-x-scroll beautify-scrollbar text-center my-4 border rounded-lg">
                <table class="w-full table-auto">
                    <thead class="">
                        <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Course') }}</th>
                        <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Progress') }}</th>
                        <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Marked Scored') }}</th>
                        <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Action') }}</th>
                    </thead>
                    <tbody class="">
                        @foreach($all_courses as $course)
                            <tr class="border-t">
                                <td class="p-4 whitespace-nowrap text-start">{{ $course->course->title }}</td>
                                <td class="p-4 whitespace-nowrap text-start">{{ $this->getStudentCourseProgressPercent($course->course, $student) }}%</td>
                                <td class="p-4 whitespace-nowrap text-start">{{ $this->getPointsOfStudentExam($course->course, $student) }} / {{ $this->getCourseTotalPoints($course->course) }}</td>
                                <td class="p-4 whitespace-nowrap text-start">
                                    <a href="javascript:;" class="open_quiz_dialog_link text-purple-500">{{ __('Show answers') }}</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Overlay element -->
    <div id="overlay" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>

    <!-- Topic dialog -->
    <div id="quiz_dialog" class="hidden fixed z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-2/3 lg:w-1/2 xl:2/5 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg">
        <h1 class="text-2xl font-semibold">{{ __('Questions') }}</h1>
        <div class="py-5">
            <button id="close_quiz_dialog" type="button" class="fill-current h-6 w-6 absolute right-0 top-0 m-4 text-3xl font-bold">×</button>
            <div id="quiz_list" class="w-full" x-data="{selected:111}">
                <div class="relative flex flex-wrap flex-col shadow mb-4 bg-white">
                    <div class="border border-green-400 mb-0 bg-gray-100 py-2 px-4">
                        <div class="d-grid mb-0">
                            <a href="javascript:;" class="py-1 px-0 w-full rounded leading-5 font-medium flex justify-between focus:outline-none focus:ring-0" @click="selected !== '111' ? selected = '111' : selected = null">
                                <span>What Are The Principles Of Effective Web Design?</span>
                                <span class="mr-3">
                                    <svg class="transform transition duration-500 -rotate-180" :class="{ '-rotate-180': selected == '111' }" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div x-show="selected == '111'">
                        <div class="flex-1 py-4 px-7">
                            <div class="flex pt-4 justify-between">
                                <div class="pt-1.5">answer 1</div>
                                <div class="min-w-fit" >
                                    <x-edit-icon-button class="edit_lesson_dialog_button"/>
                                    <x-remove-icon-button class="remove_lesson_button"/>
                                </div>
                            </div>
                            <div class="flex pt-4 justify-between">
                                <div class="pt-1.5">answer 2</div>
                                <div class="min-w-fit" >
                                    <x-edit-icon-button class="edit_lesson_dialog_button"/>
                                    <x-remove-icon-button class="remove_lesson_button"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative flex flex-wrap flex-col shadow mb-4 bg-white">
                    <div class="border border-red-400 mb-0 bg-gray-100 py-2 px-4">
                        <div class="d-grid mb-0">
                            <a href="javascript:;" class="py-1 px-0 w-full rounded leading-5 font-medium flex justify-between focus:outline-none focus:ring-0" @click="selected !== '222' ? selected = '222' : selected = null">
                                <span>How Do You Ensure That A Website Is Mobile-Friendly?</span>
                                <span class="mr-3">
                                    <svg class="transform transition duration-500 -rotate-180" :class="{ '-rotate-180': selected == '222' }" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div x-show="selected == '222'">
                        <div class="flex-1 py-4 px-7">
                            <div class="flex pt-4 justify-between">
                                <div class="pt-1.5">answer 1</div>
                                <div class="min-w-fit" >
                                    <x-edit-icon-button class="edit_lesson_dialog_button"/>
                                    <x-remove-icon-button class="remove_lesson_button"/>
                                </div>
                            </div>
                            <div class="flex pt-4 justify-between">
                                <div class="pt-1.5">answer 2</div>
                                <div class="min-w-fit" >
                                    <x-edit-icon-button class="edit_lesson_dialog_button"/>
                                    <x-remove-icon-button class="remove_lesson_button"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <Script>
        $(document).ready(function() {
            $('body').on('click', '.open_quiz_dialog_link', function(event) {
                event.preventDefault();
                $('div#quiz_dialog').removeClass('hidden');
                $('div#overlay').removeClass('hidden');
            });

            $('button#close_quiz_dialog').on('click', function() {
                closeQuizDialog();
            });

            $('div#overlay').on('click', function() {
                closeQuizDialog();
            });
        });

        function closeQuizDialog() {
            $('div#quiz_dialog').addClass('hidden');
            $('div#overlay').addClass('hidden');
        };
    </Script>
</div>
