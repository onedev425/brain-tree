<div>
    <livewire:show-user-profile :user="$student" />

    <div class="card float-left w-full mt-0 overflow-visible">
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
                            'course_id' => $course->id,
                            'title' => $course->title,
                            'image' => $course->image,
                            'created_at' => $course->created_at,
                            'lesson_nums' => count($course->lessons),
                            'quiz_nums' => count($course->questions),
                            'progress' => $this->getStudentCourseProgressPercent($course, $student),
                            'rate' => $course->course_rate(),
                            'feedback_nums' => $course->course_feedback_nums(),
                        ])
                    @endforeach
                @else
                    @foreach($completed_courses as $course)
                        @livewire('show-student-course-block', [
                            'course_id' => $course->id,
                            'title' => $course->title,
                            'image' => $course->image,
                            'created_at' => $course->created_at,
                            'lesson_nums' => count($course->lessons),
                            'quiz_nums' => count($course->questions),
                            'progress' =>  $this->getStudentCourseProgressPercent($course, $student),
                            'rate' => $course->course_rate(),
                            'feedback_nums' => $course->course_feedback_nums(),
                        ])
                    @endforeach
                @endif
            </div>
        </div>

    </div>

    <div class="card float-left w-full mt-2">
        <div class="card-body">
            <h3 class="text text-2xl m-2 font-bold">{{ __('Grades') }}</h3>
            <div class="overflow-x-scroll beautify-scrollbar text-center my-4 border rounded-lg">
                <table class="w-full table-auto">
                    <thead class="">
                        <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Course') }}</th>
                        <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Progress') }}</th>
                        <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Scored') }}</th>
                        <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Action') }}</th>
                    </thead>
                    <tbody class="">
                        @foreach($all_courses as $student_course)
                            <tr class="border-t">
                                <td class="p-4 whitespace-nowrap text-start">{{ $student_course->course->title }}</td>
                                <td class="p-4 whitespace-nowrap text-start">{{ $this->getStudentCourseProgressPercent($student_course->course, $student) }}%</td>
                                <td class="p-4 whitespace-nowrap text-start">{{ $this->getPointsOfStudentExam($student_course->course, $student) }} / {{ $this->getCourseTotalPoints($student_course->course) }}</td>
                                <td class="p-4 whitespace-nowrap text-start">
                                    @php
                                        $quiz_info = [];
                                        $student_course->load('course.questions.quiz_options');
                                        $questions = $student_course->course->questions;
                                        foreach($questions as $question) {
                                            $quiz_option_info = [];
                                            $quiz_options = $question->quiz_options;

                                            foreach($quiz_options as $quiz_option) {
                                                // get the student's answer
                                                $student_answer = $student->student_questions
                                                    ->where('course_id', $student_course->course->id)
                                                    ->where('question_id', $question->id)
                                                    ->where('question_option_id', $quiz_option->id)->first();
                                                $student_answer = $student_answer ? $student_answer->answer : null;

                                                $quiz_answer_info = new \stdClass();
                                                $quiz_answer_info->text = $quiz_option->description;
                                                $quiz_answer_info->correct_answer = $quiz_option->answer;
                                                $quiz_answer_info->student_answer = $student_answer;
                                                $quiz_option_info[] = $quiz_answer_info;
                                            }

                                            $question_info = new \stdClass();
                                            $question_info->text = $question->name;
                                            $question_info->type = $question->type;
                                            $question_info->points = $question->points;
                                            $question_info->quiz_options = $quiz_option_info;
                                            $quiz_info[] = $question_info;
                                        }
                                    @endphp
                                    <a href="javascript:;" class="open_quiz_dialog_link text-purple-500" data-quiz-info="{{ json_encode($quiz_info) }}">{{ __('Show answers') }}</a>
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
            <div id="quiz_list" class="w-full" x-data="{selected:123456789}"></div>
        </div>
    </div>

    <Script>
        $(document).ready(function() {
            $('body').on('click', '.open_quiz_dialog_link', function(event) {
                event.preventDefault();
                $('div#quiz_dialog').removeClass('hidden');
                $('div#overlay').removeClass('hidden');

                let question_content = '';
                const quiz_info = $(this).data('quiz-info');
                $.each(quiz_info, function(question_index, question) {

                    // check whether question is passed or not.
                    let question_passed_result = true;
                    $.each(question['quiz_options'], function(index, quiz_option) {
                        if (quiz_option['student_answer'] == null) {
                            question_passed_result = null;
                            return false;
                        }
                        if (quiz_option['correct_answer'] != quiz_option['student_answer']) {
                            question_passed_result = false;
                            return false;
                        }
                    });

                    let question_options_content = ''
                    $.each(question['quiz_options'], function(index, quiz_option) {
                        if (question['type'] == 'boolean' || question['type'] == 'single') {
                            question_options_content += `
                                <div class="flex justify-between answer-item">
                                    <div class="handle p-2 flex bg-gray-100 rounded-lg justify-between mb-2 w-full items-center">
                                        <div class="w-full pl-4 question-option-text">
                                            ${quiz_option['text']}
                                        </div>
                                        <div class="flex p-2 items-center">
                                            <input type="radio" class="single-answer-value h-5 w-5 text-indigo-500 border border-gray-300 rounded focus:outline-none mr-3 rounded-full" disabled ${quiz_option['student_answer'] == 1 ? 'checked' : ''}>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        else {
                            question_options_content += `
                                <div class="flex justify-between answer-item">
                                    <div class="handle p-2 flex bg-gray-100 rounded-lg justify-between mb-2 w-full items-center">
                                        <div class="w-full pl-4 question-option-text">
                                            ${quiz_option['text']}
                                        </div>
                                        <div class="flex p-2 items-center">
                                            <input type="checkbox" class="multi-answer-value h-5 w-5 text-indigo-500 border border-gray-300 rounded focus:outline-none mr-3" disabled ${quiz_option['student_answer'] == 1 ? 'checked' : ''}>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    });

                    const uuid = question_index == 0 ? '123456789' : generateUUID();
                    let question_border_class = '';
                    if (question_passed_result == true) question_border_class = 'border-green-400';
                    if (question_passed_result == false) question_border_class = 'border-red-400';

                    question_content += `
                        <div class="relative flex flex-wrap flex-col shadow mb-4 bg-white">
                            <div class="border ${question_border_class} mb-0 bg-gray-100 py-2 px-4">
                                <div class="d-grid mb-0">
                                    <a href="javascript:;" class="py-1 px-0 w-full rounded leading-5 font-medium flex justify-between focus:outline-none focus:ring-0" @click="selected !== '${uuid}' ? selected = '${uuid}' : selected = null">
                                        <span>${question['text']}</span>
                                        <span class="mr-3">
                                            <svg class="transform transition duration-500 -rotate-180" :class="{ '-rotate-180': selected == '${uuid}' }" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div x-show="selected == '${uuid}'">
                                <div class="flex-1 py-4 px-7">${question_options_content}</div>
                                <div class="text-right text-sm m-3 text-green-700">${question['points']} points</div>
                            </div>
                        </div>
                    `;
                });

                $('div#quiz_list').html(question_content);
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
        }

        function generateUUID() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0,
                    v = c === 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }
    </Script>
</div>
