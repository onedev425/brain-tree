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
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Course') }}</th>
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Marked Score') }}</th>
                <th class="capitalize p-4 whitespace-nowrap text-left">{{ __('Action') }}</th>
            </thead>
            <tbody class="text-left">
            @if ($students->isNotEmpty())
                @foreach($students as $student)
                    <tr class="border-t">
                        <td class="p-4 whitespace-nowrap text-left">
                            <div class="flex">
                                <img width="50" height="50" class="rounded-full" src="{{ $student->student_photo }}" onerror="this.src='{{ asset('images/logo/avatar.png') }}'" />
                                <a href="{{ route('students.show', $student->student_id) }}" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 text-purple-500">{{ $student->student_name }}</a>
                            </div>

                        </td>
                        <td class="p-4 whitespace-nowrap">{{ $student->course_title }}</td>
                        <td class="p-4 whitespace-nowrap">{{ $student->student_points }} / {{ $student->total_points }}</td>
                        <td class="p-4 whitespace-nowrap">
                            <a href="javascript:;" class="open_quiz_dialog_link text-purple-500" data-quiz-info="{{ $this->getQuestionInformationOfCourse($student->course_id, $student->student_id) }}">{{ __('Show answers') }}</a>
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
