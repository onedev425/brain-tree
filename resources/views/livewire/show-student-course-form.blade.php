<div>
    <!-- Begin: Lesson title -->
    <div class="card p-7">
        <div class="card-body">
            <div class="flex">
                <a href="javascript:history.back()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32.975" height="24.718" viewBox="0 0 32.975 24.718">
                        <g id="Icon_feather-arrow-left" data-name="Icon feather-arrow-left" transform="translate(-6 -5.379)">
                            <path id="Path_69" data-name="Path 69" d="M37.475,18H7.5" transform="translate(0 -0.262)" fill="none" stroke="#d93e3e" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                            <path id="Path_70" data-name="Path 70" d="M17.738,27.976,7.5,17.738,17.738,7.5" transform="translate(0 0)" fill="none" stroke="#d93e3e" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                        </g>
                    </svg>
                </a>
                <h2 class="font-bold ml-3 text-lg">{{ $course->title }}</h2>
                <h2 id="course_description" class="font-bold ml-3 text-lg" hidden>{{ $course->description }}</h2>
            </div>
        </div>
    </div>
    <!-- End: Lesson title -->

    <!-- Begin::Bad Luck -->
    <div id="bad_luck_section" class="card hidden">
        <div class="card-body text-center">
            <div class="flex justify-center mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="245.364" height="245.364" viewBox="0 0 245.364 245.364">
                    <g id="Group_322" data-name="Group 322" transform="translate(607.501 -9930.286)">
                        <circle id="Ellipse_67" data-name="Ellipse 67" cx="122.682" cy="122.682" r="122.682" transform="translate(-607.501 9930.286)" fill="#d93e3e"/>
                        <path id="Path_138" data-name="Path 138" d="M535.853,574.266c0,19.367-30.446,1.654-63.087,1.654S407.11,592.9,407.11,573.534c0-11.043,10.522-26.4,25.618-37.556h0c11.373-8.407,25.34-14.428,39.37-14.428,14.428,0,28.561,6.518,39.835,15.466C526.161,548.3,535.853,563.457,535.853,574.266Z" transform="translate(-956.3 9540.354)" fill="#444053"/>
                        <path id="Path_139" data-name="Path 139" d="M550.731,537c-17.35-2.613-48.731-5.8-79.2-1.038,11.373-8.407,25.34-14.428,39.37-14.428C525.323,521.53,539.457,528.048,550.731,537Z" transform="translate(-995.102 9540.366)" fill="#f6f8fb"/>
                        <path id="Path_140" data-name="Path 140" d="M351.591,281.31s-36.956,23.626-36.654,60.582S351.591,281.31,351.591,281.31Z" transform="translate(-900.781 9685.057)" opacity="0.05"/>
                        <path id="Path_154" data-name="Path 154" d="M415.848,447.025c2.334-.131,13.322-.958,20.3-4.939A7.91,7.91,0,0,1,439.836,441c2.219-.064,4.772.863,3.138,6.049-2.649,8.482-18.027,18.027-27.571,17.5-9.178-.509-20.067-4.207-27.257-17.211a7.954,7.954,0,0,1-.982-4.092c.083-2.625,1.038-5.913,5.965-2.247,6.657,4.951,19.287,5.89,21.82,6.029a8.385,8.385,0,0,0,.9,0Z" transform="translate(-944.284 9589.857)" fill="#444053"/>
                        <path id="Path_155" data-name="Path 155" d="M637.848,447.025c2.334-.131,13.322-.958,20.3-4.939A7.909,7.909,0,0,1,661.836,441c2.219-.064,4.772.863,3.138,6.049-2.649,8.482-18.027,18.027-27.571,17.5-9.178-.509-20.067-4.207-27.257-17.211a7.953,7.953,0,0,1-.982-4.092c.084-2.625,1.038-5.913,5.965-2.247,6.657,4.951,19.287,5.89,21.82,6.029a8.383,8.383,0,0,0,.9,0Z" transform="translate(-1078 9589.857)" fill="#444053"/>
                    </g>
                </svg>
            </div>
            <h1 class="text-center font-semibold text-2xl mt-8">{{ __('Bad Luck! Please Try Again') }}</h1>
            <div class="text-sm mt-4">{{ __("We regret to inform you that you did not pass the Web Design & Development Quiz. Please don't get disheartened and keep learning and practicing.") }}</div>
            <div class="flex justify-center mt-4">
                <x-button id="main_try_again_button" label="{{ __('Try Again') }}" icon="" class="py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent" />
                <a href="{{ route('certification.index', 'type=grade') }}" class="view_marks_button py-3 md:px-16 bg-white text-black font-semibold border border-red-300 ml-10 my-3" >{{ __('View Marks') }}</a>
            </div>
        </div>
    </div>
    <!-- End::Bad Luck -->

    <!-- Begin::Congratulations -->
    <div id="congratulation_section" class="card hidden">
        <div class="card-body text-center">
            <div class="flex justify-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="175.308" height="284.399" viewBox="0 0 175.308 284.399">
                    <g id="undraw_celebrating_rtuv" transform="translate(0)">
                        <circle id="Ellipse_55" data-name="Ellipse 55" cx="25.144" cy="25.144" r="25.144" transform="translate(60.36 99.593)" fill="#0f743c"/>
                        <path id="Path_74" data-name="Path 74" d="M491.156,512.823a3.292,3.292,0,0,1-1.864-2.792l-.366-6.924a3.292,3.292,0,0,1,3.111-3.458l57.713-3.049a3.292,3.292,0,0,1,3.458,3.11l.366,6.925a3.292,3.292,0,0,1-3.11,3.457l-57.713,3.049a3.269,3.269,0,0,1-1.593-.318Z" transform="translate(-466.805 -326.904)" fill="#0f743c"/>
                        <path id="Path_75" data-name="Path 75" d="M558.8,510.923a3.3,3.3,0,0,1-1.863-2.991l-.068-13.037a3.288,3.288,0,0,1,3.316-3.264l26.329,2.321c.7,0,1.577,1.084,2.284,1.951.222.272.413.507.553.649.061.062.12.127.175.193h0a3.283,3.283,0,0,1,.768,2.141l-.058,6.933a3.293,3.293,0,0,1-3.316,3.261l-26.7,2.167A3.315,3.315,0,0,1,558.8,510.923Z" transform="translate(-494.662 -324.868)" fill="#2f2e41"/>
                        <path id="Path_76" data-name="Path 76" d="M580.944,645.63h-6.934a3.292,3.292,0,0,1-3.289-3.289V583.609a3.292,3.292,0,0,1,3.289-3.289h6.934a3.292,3.292,0,0,1,3.289,3.289v58.733a3.292,3.292,0,0,1-3.289,3.288Z" transform="translate(-500.342 -361.23)" fill="#0f743c"/>
                        <path id="Path_77" data-name="Path 77" d="M611.944,645.63h-6.934a3.292,3.292,0,0,1-3.289-3.289V583.609a3.292,3.292,0,0,1,3.289-3.289h6.934a3.292,3.292,0,0,1,3.289,3.289v58.733a3.292,3.292,0,0,1-3.289,3.288Z" transform="translate(-513.052 -361.23)" fill="#0f743c"/>
                        <path id="Path_78" data-name="Path 78" d="M597.523,425.082l.026-.94c-1.748-.049-3.289-.158-4.447-1a2.888,2.888,0,0,1-1.119-2.127,1.651,1.651,0,0,1,.542-1.36,2.846,2.846,0,0,1,2.907-.026l.777.357-1.491-10.9-.931.128,1.268,9.268a3.317,3.317,0,0,0-3.138.451,2.57,2.57,0,0,0-.874,2.111,3.821,3.821,0,0,0,1.5,2.853C594.035,424.984,595.969,425.038,597.523,425.082Z" transform="translate(-508.672 -291.026)" fill="#2f2e41"/>
                        <rect id="Rectangle_199" data-name="Rectangle 199" width="5.061" height="0.94" transform="translate(75.451 118.987)" fill="#2f2e41"/>
                        <rect id="Rectangle_200" data-name="Rectangle 200" width="5.061" height="0.94" transform="translate(91.425 118.987)" fill="#2f2e41"/>
                        <path id="Path_79" data-name="Path 79" d="M604.34,525.269,581.132,478.99h.327a3.057,3.057,0,0,0,3.054-3.054V475a3.057,3.057,0,0,0-3.054-3.054H571.124A3.057,3.057,0,0,0,568.07,475v.94a3.047,3.047,0,0,0,2.7,3.018L547.5,525.294a14.455,14.455,0,0,0,12.917,20.943H591.4a14.478,14.478,0,0,0,12.942-20.968Z" transform="translate(-490.19 -316.796)" fill="#2f2e41"/>
                        <path id="Path_80" data-name="Path 80" d="M596.878,484.409l52.35-24.486a3.292,3.292,0,0,1,4.372,1.585l2.938,6.281a3.292,3.292,0,0,1-1.586,4.372L602.6,496.648a3.292,3.292,0,0,1-4.372-1.585l-2.938-6.281a3.266,3.266,0,0,1-.111-2.514,3.3,3.3,0,0,1,.49-.894A3.268,3.268,0,0,1,596.878,484.409Z" transform="translate(-510.289 -311.742)" fill="#0f743c"/>
                        <path id="Path_81" data-name="Path 81" d="M593.872,491.612l23.047-13.738a3.292,3.292,0,0,1,4.388,1.536l5.812,11.677a3.287,3.287,0,0,1-1.555,4.4l-24.62,9.511c-.645.31-1.91-.27-2.927-.737-.319-.146-.594-.272-.783-.338h0c-.083-.029-.164-.061-.243-.1a3.282,3.282,0,0,1-1.633-1.582l-3.006-6.249a3.3,3.3,0,0,1,.362-3.442,3.221,3.221,0,0,1,1.158-.937Z" transform="translate(-509.077 -319.095)" fill="#2f2e41"/>
                        <path id="Path_82" data-name="Path 82" d="M561.815,376.343a1.273,1.273,0,0,1-1.269-1.27,1.18,1.18,0,0,1,.033-.3l6.572-28.948a1.277,1.277,0,0,1,2.109-.656l21.788,20.176a1.277,1.277,0,0,1-.485,2.154L562.2,376.285A1.314,1.314,0,0,1,561.815,376.343Z" transform="translate(-496.17 -264.684)" fill="#3f3d56"/>
                        <path id="Path_83" data-name="Path 83" d="M131.955,150.83l-13.686-2.723.215-.951,12.1,2.405Z" transform="translate(-48.49 -60.333)" fill="#fff"/>
                        <path id="Path_84" data-name="Path 84" d="M141.547,166.021l-26.167-5.207.215-.955,24.58,4.888Z" transform="translate(-47.305 -65.541)" fill="#fff"/>
                        <path id="Path_85" data-name="Path 85" d="M131,176.209l-1.964.607L112.5,173.524l.215-.955Z" transform="translate(-46.124 -70.752)" fill="#fff"/>
                        <circle id="Ellipse_56" data-name="Ellipse 56" cx="4" cy="4" r="4" transform="translate(145 104)" fill="#0f743c"/>
                        <circle id="Ellipse_57" data-name="Ellipse 57" cx="3" cy="3" r="3" transform="translate(93)" fill="#ff6584"/>
                        <circle id="Ellipse_58" data-name="Ellipse 58" cx="3" cy="3" r="3" transform="translate(28 91)" fill="#ff6584"/>
                        <ellipse id="Ellipse_59" data-name="Ellipse 59" cx="2.5" cy="3" rx="2.5" ry="3" transform="translate(132 81)" fill="#0f743c"/>
                        <ellipse id="Ellipse_60" data-name="Ellipse 60" cx="3" cy="2.5" rx="3" ry="2.5" transform="translate(42 122)" fill="#0f743c"/>
                        <circle id="Ellipse_61" data-name="Ellipse 61" cx="3" cy="3" r="3" transform="translate(135 130)" fill="#e6e6e6"/>
                        <circle id="Ellipse_62" data-name="Ellipse 62" cx="3" cy="3" r="3" transform="translate(109 25)" fill="#ccc"/>
                        <path id="Path_86" data-name="Path 86" d="M452.036,315.1a19.587,19.587,0,0,1,15.32,9.075c.464.741,1.069,1.556.748,2.469a1.623,1.623,0,0,1-1.682,1.123,2.127,2.127,0,0,1-.22-4.1c2.142-.914,4.3.5,6.049,1.626,3.976,2.568,8.35,4.891,13.168,5.184,4.458.271,9.239-1.477,11.718-5.343.434-.676-.643-1.3-1.075-.628-2.459,3.834-7.431,5.211-11.753,4.619a22.85,22.85,0,0,1-7.354-2.5c-1.188-.617-2.34-1.3-3.469-2.019a22.142,22.142,0,0,0-3.4-1.951c-1.984-.815-4.611-.751-6,1.125a3.417,3.417,0,0,0,1.869,5.158,2.922,2.922,0,0,0,3.423-3.477,8.524,8.524,0,0,0-1.593-2.883,20.833,20.833,0,0,0-15.751-8.726c-.8-.04-.8,1.205,0,1.245Z" transform="translate(-451.436 -251.98)" fill="#ccc"/>
                        <path id="Path_87" data-name="Path 87" d="M728.929,362.145a15.578,15.578,0,0,1-7.122-12.241c-.035-.695-.139-1.5.437-2a1.291,1.291,0,0,1,1.6-.128,1.692,1.692,0,0,1-1.437,2.932c-1.842-.2-2.8-2.014-3.571-3.474-1.766-3.325-3.9-6.634-7.136-8.7-2.991-1.916-6.989-2.555-10.209-.832-.563.3-.058,1.153.5.853,3.194-1.71,7.181-.739,9.953,1.348a18.173,18.173,0,0,1,4.14,4.585c.586.889,1.122,1.81,1.627,2.747a17.616,17.616,0,0,0,1.607,2.674c1.062,1.335,2.911,2.309,4.6,1.543a2.718,2.718,0,0,0,.7-4.306,2.324,2.324,0,0,0-3.725,1.087,6.78,6.78,0,0,0-.011,2.619,16.57,16.57,0,0,0,7.556,12.166c.541.338,1.022-.528.483-.865Z" transform="translate(-553.857 -261.344)" fill="#ccc"/>
                        <path id="Path_88" data-name="Path 88" d="M550.644,232.878a15.579,15.579,0,0,1-12.185-7.218c-.369-.59-.85-1.238-.6-1.964a1.291,1.291,0,0,1,1.338-.893,1.692,1.692,0,0,1,.175,3.26c-1.7.727-3.423-.4-4.811-1.293-3.163-2.043-6.641-3.89-10.473-4.123-3.546-.215-7.348,1.175-9.32,4.25-.345.538.512,1.035.855.5,1.956-3.049,5.91-4.145,9.348-3.673a18.172,18.172,0,0,1,5.849,1.986c.945.49,1.861,1.034,2.759,1.605a17.608,17.608,0,0,0,2.706,1.551c1.578.648,3.667.6,4.77-.895a2.718,2.718,0,0,0-1.486-4.1,2.324,2.324,0,0,0-2.723,2.765,6.779,6.779,0,0,0,1.267,2.293,16.57,16.57,0,0,0,12.527,6.941c.637.031.635-.959,0-.99Z" transform="translate(-477.37 -213.759)" fill="#ccc"/>
                        <rect id="Rectangle_201" data-name="Rectangle 201" width="2.95" height="9.693" transform="translate(72.571 50.488)" fill="#ccc"/>
                        <rect id="Rectangle_202" data-name="Rectangle 202" width="2.899" height="9.527" transform="translate(29.871 41.673) rotate(135)" fill="#b3b3b3"/>
                        <rect id="Rectangle_203" data-name="Rectangle 203" width="2.899" height="9.527" transform="translate(112.817 66.142) rotate(-135)" fill="#b3b3b3"/>
                        <rect id="Rectangle_204" data-name="Rectangle 204" width="2.899" height="9.527" transform="translate(29.037 149.923) rotate(-135)" fill="#ff6584"/>
                    </g>
                </svg>

            </div>
            <h1 class="text-center font-semibold text-2xl mt-8">{{ __('Congratulations!') }}</h1>
            <div class="text-sm mt-4">{{ __("You've successfully passed the Web Design & Development Quiz. Your hard work and dedication have paid off! To view your marks and download your certificate, please click the buttons below.") }}</div>
            <div class="flex justify-center mt-4">
                <a href="{{ route('certification.download', 'id=' . urlencode(base64_encode(date('s:i:H Y-m-d') . '&' . $course->id))) }}" class="py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent" >{{ __('Download Certificate') }}</a>
                <a href="{{ route('certification.index', 'type=certification') }}" class="view_marks_button py-3 md:px-20 bg-white text-black font-semibold border border-red-300 ml-10" >{{ __('View Marks') }}</a>
            </div>
        </div>
    </div>
    <!-- End::Congratulations -->

    <!-- Begin:Lesson content area -->
    <div id="lesson_quiz_section" class="card p-0">
        <div class="card-body">
            <div class="xl:grid grid-cols-12 gap-2 w-full">
                <!-- <div class="relative"> -->
                    <!-- <div id="leftDrawer" class=" fixed top-0 left-0 h-full w-64 bg-gray-200 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out">                 -->
                    <div id="leftDrawer"  class="relative col-span-5 bg-neutral-300 bg-white rounded-xl p-6 pb-10 transform -translate-x-full transition-transform duration-300 ease-in-out">
                        <h1 class="text-xl font-bold mb-4">{{ __('Lessons') }}</h1>
                        <button id="drawerToggle" class="p-2 bg-blue-500" style="position: absolute; top:15px; right:20px; font-size:20px; font-weight:600">X</button>
                        <div id="topic_list" x-data="{selected:0000}">
                        @foreach($topics as $topic_index => $topic)
                        @php $uuid = $topic_index == 0 ? '0000' : Illuminate\Support\Str::uuid()->toString(); @endphp
                        <div class="relative flex flex-wrap flex-col mb-2">
                            <div class="border-b border-gray-200 mb-0 bg-gray-100 py-2 px-4 mt-2 rounded" style="max-width: 100%;">
                                <div class="d-grid mb-0">
                                    <a href="javascript:;" class="py-1 px-0 w-full rounded leading-5 font-medium flex justify-between focus:outline-none focus:ring-0 topic-item" 
                                        data-lesson-count="{{ count($topic->lessons) }}" data-topic-description="{{$topic->description }}" data-topicvideo-duration="{{ $this->getTopicVideoDuration($topic) }}"
                                        data-uuid="{{$uuid}}" 
                                        @click="selected !== '{{$uuid}}' ? selected = '{{$uuid}}' : selected = null">
                                        <div class="flex mt-1.5">
                                            <span class="mr-3">
                                                <svg class="transform transition duration-500 -rotate-90" :class="{ 'rotate-0': selected == '{{$uuid}}' }" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                            <span class="topic_info">{!! $topic->description !!}</span>
                                        </div>
                                        <div class="flex mt-1.5">
                                            <span class="text-sm text-gray-600 lesson-count">
                                                {{ count($topic->lessons) }} {{ __('Lessons') }} • {{ $this->getTopicVideoDuration($topic) }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion outline-1" style="max-width:100%;" x-show="selected == '{{$uuid}}'">
                                <ul class="bg-white" style="border-width: 0px 1px 1px 1px; border-color: #c6c6c6; border-radius: 6px">
                                    @foreach($topic->lessons as $lesson_index => $lesson)
                                        <li class="lesson-quiz-item lesson-item flex py-1 px-3 justify-between hover:bg-gray-200 {{ $this->isLessonCompleted($lesson->id) ? 'text-green-700' : '' }} {{ $topic_index == 0 && $lesson_index == 0 ? 'active' : '' }}">
                                            <div class="flex items-center overflow-hidden" style="max-width: 80%;">
                                                <span class="w-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="244 3761 20 17">
                                                        <path d="M262 3771.31v2.46l-2.233-1.44 2.233-1.23v.21Zm-6 3.6c0 .57-.448 1.03-1 1.03h-8c-.552 0-1-.46-1-1.03v-4.12c0-.57.448-1.03 1-1.03h8c.552 0 1 .46 1 1.03v4.12Zm-7.89-9.79c.552 0 1 .46 1 1.03 0 .57-.448 1.03-1 1.03-.551 0-1-.46-1-1.03 0-.57.449-1.03 1-1.03Zm5-2.06c1.103 0 2 .92 2 2.06 0 1.14-.897 2.06-2 2.06-1.102 0-2-.92-2-2.06 0-1.14.898-2.06 2-2.06Zm9.36 5.11-4.47 2.87v-1.8c0-1.01-.62-1.84-1.548-2.02.357-.62.617-1.33.617-2.1 0-2.27-1.77-4.12-3.979-4.12-1.617 0-2.991.99-3.622 2.42a2.873 2.873 0 0 0-1.363-.36c-1.657 0-2.997 1.38-2.997 3.09 0 .43.004.84.159 1.21-.697.33-1.267 1.04-1.267 1.88v6.18c0 1.14 1.062 2.58 2.167 2.58h10c1.104 0 1.833-1.44 1.833-2.58v-1.79l4.47 2.87c.667.43 1.53-.06 1.53-.87v-6.59c0-.81-.863-1.3-1.53-.87Z" fill-rule="evenodd" data-name="video_camera_round-[#964]"/>
                                                    </svg>
                                                </span>
                                                <a href="javascript:;" class="ml-2"  style="display: inline-block; max-width:80%; white-space: nowrap; overflow:hidden; text-overflow:ellipsis;" data-lesson-id="{{ $lesson->id }}" data-attachment-file="{{ $lesson->attachment_file }}" data-content="{!! htmlspecialchars($lesson->description) !!}" data-video-url="{{ $this->getVideoEmbedURL($lesson->video_type, $lesson->video_link) }}">{!! $lesson->title !!}</a>
                                            </div>
                                            <p class="text-sm text-right">{{ $this->getLessonVideoDuration($lesson->video_duration) }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                            <div class="relative flex flex-wrap flex-col mb-2">
                                <div class="border-b border-gray-200 mb-0 bg-gray-100 py-2 px-4 mt-2 rounded">
                                    <div class="d-grid mb-0">
                                        <a href="javascript:;" class="py-1 px-0 w-full rounded leading-5 font-medium flex justify-between focus:outline-none focus:ring-0" @click="selected !== '9999' ? selected = '9999' : selected = null" data-quizzes-count="{{ count($course->questions) }}" >
                                        <div class="flex mt-1.5">
                                                    <span class="mr-3">
                                                        <svg class="transform transition duration-500 -rotate-90" :class="{ 'rotate-0': selected == '9999' }" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                <span class="topic_info" data-uuid="9999">{{ __('Final Quiz') }}</span>
                                            </div>
                                            <div class="flex mt-1.5">
                                                <span class="text-sm text-gray-600">{{ count($course->questions) }} {{ count($course->questions) == 1 ? __('Quiz') : __('Quizzes') }}</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="accordion p-3" x-show="selected == '9999'">
                                    <ul>
                                        @php
                                            $questions = $course->questions()->with('quiz_options')->get();
                                            $prev_quiz_processed = $this->isAllLessonCompleted($course);
                                        @endphp
                                        @foreach($questions as $question)
                                            @php
                                                $quiz_option_id = [];
                                                $quiz_option_text = [];
                                                foreach($question->quiz_options as $quiz_option) {
                                                    $quiz_option_id[] = $quiz_option->id;
                                                    $quiz_option_text[] = $quiz_option->description;
                                                }
                                            @endphp
                                            <li class="lesson-quiz-item {{ $prev_quiz_processed ? 'quiz-item hover:bg-gray-200 hover:rounded-2xl' : '' }} flex py-1 px-3 justify-between {{ $this->isQuestionCompleted($question->id) ? 'text-green-700' : '' }}">
                                                <div class="flex">
                                                    <span class="w-5">
                                                        <svg class="mt-1" xmlns="http://www.w3.org/2000/svg" width="19.313" height="19.313" viewBox="0 0 19.313 19.313">
                                                            <g transform="translate(-8.2 -8.2)">
                                                                <g transform="translate(8.2 8.2)" fill="currentColor">
                                                                    <path d="M-160.144-250.487a9.656,9.656,0,0,1-9.656-9.656,9.656,9.656,0,0,1,9.656-9.656,9.656,9.656,0,0,1,9.656,9.656,9.656,9.656,0,0,1-9.656,9.656Zm0-18.262a8.639,8.639,0,0,0-8.606,8.606,8.639,8.639,0,0,0,8.606,8.606,8.639,8.639,0,0,0,8.606-8.606,8.613,8.613,0,0,0-8.606-8.606Z" transform="translate(169.8 269.8)"/>
                                                                    <path d="M-153.56-256.48a2.9,2.9,0,0,1,.646-1.091,3.159,3.159,0,0,1,1.05-.687,3.841,3.841,0,0,1,1.414-.242,3.754,3.754,0,0,1,1.172.2,3.719,3.719,0,0,1,.97.525,2.264,2.264,0,0,1,.646.848,2.637,2.637,0,0,1,.242,1.172,2.629,2.629,0,0,1-.364,1.414,6.008,6.008,0,0,1-.929,1.131l-.727.727a1.531,1.531,0,0,0-.4.525,1.339,1.339,0,0,0-.162.606,4.675,4.675,0,0,0-.04.848h-.929a3.04,3.04,0,0,1,.081-.929,3,3,0,0,1,.283-.848,4.1,4.1,0,0,1,.525-.727c.242-.242.485-.485.808-.768a2.765,2.765,0,0,0,.687-.848,1.958,1.958,0,0,0,.283-1.051,1.809,1.809,0,0,0-.162-.808,3.662,3.662,0,0,0-.444-.646,1.3,1.3,0,0,0-.687-.4,2.612,2.612,0,0,0-.808-.162,2.7,2.7,0,0,0-1.05.2,1.82,1.82,0,0,0-.768.566,2.138,2.138,0,0,0-.444.848,2.563,2.563,0,0,0-.121.97h-.929a3,3,0,0,1,.162-1.374Zm2.424,7.071H-150v1.131h-1.131Z" transform="translate(160.226 263.066)"/>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    <a href="javascript:;" class="ml-2" data-question-id="{{ $question->id }}" data-description="{!! htmlspecialchars($question->description) !!}" data-question-option-ids="{{ json_encode($quiz_option_id) }}" data-question-options="{{ json_encode($quiz_option_text) }}">{{ $question->name }}</a>
                                                </div>
                                                <div class="text-sm">{{ $question->points }} {{ __('Points') }}</div>
                                            </li>
                                            @php
                                                $prev_quiz_processed = $this->isQuestionCompleted($question->id);
                                            @endphp
                                        @endforeach
                                    </ul>
                                    @if ($prev_quiz_processed && ! $passed_exam)
                                        <div class="flex justify-end mt-4">
                                            <x-button id="sub_try_again_button" label="{{ __('Try Again') }}" icon="" class="py-1 md:px-4 bg-red-700 text-white font-semibold border-transparent" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
                
                <div id="lesson_section" class="relative col-span-7 p-6">
                    <div id="toggle_lessons" class="flex justify-end mt-10 hidden" style="position: absolute; top:10px;">
                        <a href="#" class="flex items-center px-4 py-2 bg-gray-500 text-white rounded">
                            <span>Lessons</span>
                            <svg class="ml-2 w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <!-- <h1 id="lesson_title" class="text-xl font-bold mb-4"></h1> -->
                    <!-- <div id="lesson_content" class="my-5"></div> -->
                    <div class="w-full mx-auto max-w-screen-lg">
                    <div class="aspect-w-16 aspect-h-9 flex justify-center">
                        <iframe id="lesson_video" class="w-full lg:w-5/5 h-96" src="" frameborder="1" allowfullscreen></iframe>
                    </div>
                    <div class="overflow-hidden md:overflow-auto flex border-b-2 border-gray-300">
                        <a href="javascript:;" onclick="setActiveTab('description')" class="py-2 px-2 lg:px-4 w-full text-center text-black cursor-pointer block font-semibold border-b-4 border-transparent active" id="tab-description">
                            {{ __('Description') }}
                        </a>
                        <a href="javascript:;" onclick="setActiveTab('resources')" class="py-2 px-2 lg:px-4 w-full text-center text-black cursor-pointer block font-semibold border-b-4 border-transparent" id="tab-resources">
                            {{ __('Resources') }}
                        </a>
                        <a href="javascript:;" onclick="setActiveTab('announcements')" class="py-2 px-2 lg:px-4 w-full text-center text-black cursor-pointer block font-semibold border-b-4 border-transparent" id="tab-announcements">
                            {{ __('Announcements') }}
                        </a>
                        <a href="javascript:;" onclick="setActiveTab('reviews')" class="py-2 px-2 lg:px-4 w-full text-center text-black cursor-pointer block font-semibold border-b-4 border-transparent" id="tab-reviews">
                            {{ __('Reviews') }}
                        </a>
                    </div>

                    <div id="tab-content">
                        <div id="content-description" class="tab-content hidden">
                            <h3 class="py-4 text text-lg font-bold">{{ __('About This Course') }}</h3>
                            <div id="topic_description" class="mt-0 mb-4"></div>
                            <h3 class="py-2 text-sm font-bold">{{ __('Course Overview') }}</h3>
                            <table class="w-full border-collapse">
                                <tr>
                                    <td id="lesson_students" class="p-2 text-left text-sm">{{ __('Students: ') }} {{count($course->course_students)}}</td>
                                    <td id="lesson_lectures" class="p-2 text-left text-sm">{{ __('Lectures: ') }}<span id="lectures_count"></span></td>
                                    <td id="lesson_quizzes" class="p-2 text-left text-sm">{{ __('Quizzes: ') }}<span id="quizzes_count">{{ count($course->questions) }}</span></td>
                                </tr>
                                <tr>
                                    <td id="lesson_languages" class="p-2 text-left text-sm">{{ __('Languages: ') }}{{ __('English') }}</td>
                                    <td id="lesson_video" class="p-2 text-left text-sm">{{ __('Video: ') }}<span id="topicvideo_duration"></span></td>
                                </tr>
                            </table>                        
                        </div>
                        <div id="content-resources" class="tab-content flex hidden gap-1 flex-col">
                            <h3 class="py-4 text text-lg font-bold">{{ __('Lesson Resources') }}</h3>
                            <div class="my-4" id="buttonContainer" class="flex flex-wrap gap-1">
                                <!-- Buttons will be added here dynamically -->
                            </div>
                        </div>
                        <div id="content-announcements" class="tab-content hidden ">
                            <h3 class="py-4 text text-lg font-bold">{{ __('Announcements') }}</h3>
                            <table>
                                @foreach($course->announcements as $announcement)
                                    <div class="announcement-item border-b-2 border-gray-300">
                                        <!-- Title -->
                                        <h3 class="py-0 text text-base font-bold content-wrap overflow-hidden">{{ $announcement->title }}</h3>
                                        <!-- Content -->
                                        <div class="p-2 text-left text-sm content-wrap overflow-hidden">{{ $announcement->content }}</div>
                                        <!-- Attachment (Image) -->
                                        @if(!empty($announcement->attachment_file))
                                            <div class="mt-2 max-w-[70%]">
                                                <img src="{{ $announcement->attachment_file }}" alt="Attachment" class="max-w-full h-auto" style="max-width:70%;"/>
                                            </div>
                                        @endif
                                        <!-- Separator Line -->
                                        <div class="underline mt-4"></div>
                                    </div>
                                @endforeach
                            </table>
                            <!-- Announcements content goes here -->
                        </div>
                        <div id="content-reviews" class="tab-content hidden">
                            <h3 class="py-4 text text-lg font-bold">{{ __('Student Feedback') }}</h3>
                            <table class="w-full border-collapse">
                                <tr class="flex w-full">
                                    <td class="text-center flex-3 flex"> <!-- Centers the text inside the table cell -->
                                        <div class="flex flex-col items-center justify-center gap-4">
                                            <span class="text-orange-500 bg-white text-3xl px-2 mr-1 h-6 font-bold" style="color:orange">
                                                {{ number_format(round($course->course_rate(), 1), 1) }}
                                            </span>
                                            <span id="course_{{$course->id}}_rating" class="rating-progress mt-0.5 mr-2" style="scale:1.5"></span>
                                            <span class="p-2 text-center text-sm" style="color:orange">{{__('COURSE RATING')}}</span>
                                            @php($rating_progress = intval($course->course_rate() / 5 * 100) . '%' ?? 0)
                                        </div>
                                    </td>
                                    <td class="flex-1">
                                        <div class="p-4">
                                            <div class="flex gap-3 items-center">
                                                <div class="hidden md:flex md:items-center" style="width: 80%;">
                                                    <div class="bg-gray-500 h-2 rounded" style="width: {{$course->course_feedback_array()[5]}}%;"></div>
                                                    <div class="bg-gray-100 h-2 rounded" style="width: {{100 - $course->course_feedback_array()[5]}}%;"></div>
                                                </div>
                                                <span id="star_five_rating" class=" rating-progress mt-0.5 mr-2" style="min-width: 80px;"></span>
                                                <p style="min-width: 40px;">{{$course->course_feedback_array()[5]}}%</p>
                                            </div>
                                            <div class="flex gap-3 items-center">
                                                <div class="hidden md:flex md:items-center" style="width: 80%;">
                                                    <div class="bg-gray-500 h-2 rounded" style="width: {{$course->course_feedback_array()[4]}}%;"></div>
                                                    <div class="bg-gray-100 h-2 rounded" style="width: {{100 - $course->course_feedback_array()[4]}}%;"></div>
                                                </div>
                                                <span id="star_four_rating" class="rating-progress mt-0.5 mr-2" style="min-width: 80px;"></span>
                                                <p style="min-width: 40px;">{{$course->course_feedback_array()[4]}}%</p>
                                            </div>
                                            <div class="flex gap-3 items-center">
                                                <div class="hidden md:flex md:items-center" style="width: 80%;">
                                                    <div class="bg-gray-500 h-2 rounded" style="width: {{$course->course_feedback_array()[3]}}%;"></div>
                                                    <div class="bg-gray-100 h-2 rounded" style="width: {{100 - $course->course_feedback_array()[3]}}%;"></div>
                                                </div>
                                                <span id="star_three_rating" class="rating-progress mt-0.5 mr-2" style="min-width: 80px;"></span>
                                                <p style="min-width: 40px;">{{$course->course_feedback_array()[3]}}%</p>
                                            </div>
                                            <div class="flex gap-3 items-center">
                                                <div class="hidden md:flex md:items-center" style="width: 80%;">
                                                    <div class="bg-gray-500 h-2 rounded" style="width: {{$course->course_feedback_array()[2]}}%;"></div>
                                                    <div class="bg-gray-100 h-2 rounded" style="width: {{100 - $course->course_feedback_array()[2]}}%;"></div>
                                                </div>
                                                <span id="star_two_rating" class=" rating-progress mt-0.5 mr-2"  style="min-width: 80px;"></span>
                                                <p style="min-width: 40px;">{{$course->course_feedback_array()[2]}}%</p>
                                            </div>
                                            <div class="flex gap-3 items-center">
                                                <div class="hidden md:flex md:items-center" style="width: 80%;">
                                                    <div class="bg-gray-500 h-2 rounded" style="width: {{$course->course_feedback_array()[1]}}%;"></div>
                                                    <div class="bg-gray-100 h-2 rounded" style="width: {{100 - $course->course_feedback_array()[1]}}%;"></div>
                                                </div>
                                                <span id="star_one_rating" class="rating-progress mt-0.5 mr-2" style="min-width: 80px;"></span>
                                                <p style="min-width: 40px;">{{$course->course_feedback_array()[1]}}%</p>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
                    
                    <!-- <div class="flex justify-end mt-10 {{ $passed_exam ? 'hidden' : '' }}">
                        <h2 class="font-bold mr-3 text-lg">{{ __('Next') }}</h2>
                        <a id="next_lesson" href="javascript:;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.975" height="24.718" viewBox="0 0 32.975 24.718">
                                <g id="Icon_feather-arrow-left" data-name="Icon feather-arrow-left" transform="translate(38.975 30.097) rotate(180)">
                                    <path id="Path_69" data-name="Path 69" d="M37.475,18H7.5" transform="translate(0 -0.262)" fill="none" stroke="#d93e3e" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                    <path id="Path_70" data-name="Path 70" d="M17.738,27.976,7.5,17.738,17.738,7.5" transform="translate(0 0)" fill="none" stroke="#d93e3e" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                </g>
                            </svg>
                        </a>
                    </div> -->

                </div>

                <div id="quiz_section" class="hidden col-span-7 p-6">
                    <h1 class="text-xl font-bold mb-4">{{ __('Final Quiz') }}</h1>
                    <div id="quiz_title" class="my-5"></div>
                    <div id="quiz_description" class="my-5 text-gray-400"></div>
                    <div id="question_list"></div>

                    <div class="flex justify-end mt-10 {{ $passed_exam ? 'hidden' : '' }}">
                        <h2 class="font-bold mr-3 text-lg">{{ __('Next') }}</h2>
                        <a id="next_quiz" href="javascript:;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.975" height="24.718" viewBox="0 0 32.975 24.718">
                                <g id="Icon_feather-arrow-left" data-name="Icon feather-arrow-left" transform="translate(38.975 30.097) rotate(180)">
                                    <path id="Path_69" data-name="Path 69" d="M37.475,18H7.5" transform="translate(0 -0.262)" fill="none" stroke="#d93e3e" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                    <path id="Path_70" data-name="Path 70" d="M17.738,27.976,7.5,17.738,17.738,7.5" transform="translate(0 0)" fill="none" stroke="#d93e3e" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                </g>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End:Lesson content area -->

    <!-- Overlay element -->
    <div id="overlay" class="fixed hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60"></div>

    <!-- Feedback dialog -->
    <div id="feedback_dialog" class="hidden fixed z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-2/3 lg:w-1/2 xl:2/5 bg-white rounded-md px-8 py-6 space-y-5 drop-shadow-lg">
        <h1 class="text-2xl font-semibold">{{ __('Feedback Form') }}</h1>
        <div class="py-5">
            <input type="hidden" name="star_nums" value="0" />
            <button id="close_feedback_dialog" type="button" class="fill-current h-6 w-6 absolute right-0 top-0 m-4 text-3xl font-bold">×</button>
            <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                <label for="" class="font-bold inline-block mb-2">{{ __('Overall Ratings') }}</label>
                <div class="flex">
                    <svg id="star-1" class="star-icon unfilled-star cursor-pointer mr-1" width="32" height="32" viewBox="0 0 15.813 14.683">
                        <path id="Icon_ionic-ios-star" data-name="Icon ionic-ios-star" d="M17.463,8.458H12.271L10.693,3.749a.572.572,0,0,0-1.073,0L8.042,8.458H2.815a.566.566,0,0,0-.565.565.415.415,0,0,0,.011.1.543.543,0,0,0,.236.4l4.267,3.007L5.127,17.285a.566.566,0,0,0,.194.635.546.546,0,0,0,.318.138.692.692,0,0,0,.353-.127l4.165-2.968,4.165,2.968a.661.661,0,0,0,.353.127.507.507,0,0,0,.314-.138.559.559,0,0,0,.194-.635l-1.638-4.761,4.232-3.035.1-.088a.54.54,0,0,0-.416-.942Z" transform="translate(-2.25 -3.375)" fill="currentColor"/>
                    </svg>
                    <svg id="star-2" class="star-icon unfilled-star cursor-pointer mr-1" width="32" height="32" viewBox="0 0 15.813 14.683">
                        <path id="Icon_ionic-ios-star" data-name="Icon ionic-ios-star" d="M17.463,8.458H12.271L10.693,3.749a.572.572,0,0,0-1.073,0L8.042,8.458H2.815a.566.566,0,0,0-.565.565.415.415,0,0,0,.011.1.543.543,0,0,0,.236.4l4.267,3.007L5.127,17.285a.566.566,0,0,0,.194.635.546.546,0,0,0,.318.138.692.692,0,0,0,.353-.127l4.165-2.968,4.165,2.968a.661.661,0,0,0,.353.127.507.507,0,0,0,.314-.138.559.559,0,0,0,.194-.635l-1.638-4.761,4.232-3.035.1-.088a.54.54,0,0,0-.416-.942Z" transform="translate(-2.25 -3.375)" fill="currentColor"/>
                    </svg>
                    <svg id="star-3" class="star-icon unfilled-star cursor-pointer mr-1" width="32" height="32" viewBox="0 0 15.813 14.683">
                        <path id="Icon_ionic-ios-star" data-name="Icon ionic-ios-star" d="M17.463,8.458H12.271L10.693,3.749a.572.572,0,0,0-1.073,0L8.042,8.458H2.815a.566.566,0,0,0-.565.565.415.415,0,0,0,.011.1.543.543,0,0,0,.236.4l4.267,3.007L5.127,17.285a.566.566,0,0,0,.194.635.546.546,0,0,0,.318.138.692.692,0,0,0,.353-.127l4.165-2.968,4.165,2.968a.661.661,0,0,0,.353.127.507.507,0,0,0,.314-.138.559.559,0,0,0,.194-.635l-1.638-4.761,4.232-3.035.1-.088a.54.54,0,0,0-.416-.942Z" transform="translate(-2.25 -3.375)" fill="currentColor"/>
                    </svg>
                    <svg id="star-4" class="star-icon unfilled-star cursor-pointer mr-1" width="32" height="32" viewBox="0 0 15.813 14.683">
                        <path id="Icon_ionic-ios-star" data-name="Icon ionic-ios-star" d="M17.463,8.458H12.271L10.693,3.749a.572.572,0,0,0-1.073,0L8.042,8.458H2.815a.566.566,0,0,0-.565.565.415.415,0,0,0,.011.1.543.543,0,0,0,.236.4l4.267,3.007L5.127,17.285a.566.566,0,0,0,.194.635.546.546,0,0,0,.318.138.692.692,0,0,0,.353-.127l4.165-2.968,4.165,2.968a.661.661,0,0,0,.353.127.507.507,0,0,0,.314-.138.559.559,0,0,0,.194-.635l-1.638-4.761,4.232-3.035.1-.088a.54.54,0,0,0-.416-.942Z" transform="translate(-2.25 -3.375)" fill="currentColor"/>
                    </svg>
                    <svg id="star-5" class="star-icon unfilled-star cursor-pointer mr-1" width="32" height="32" viewBox="0 0 15.813 14.683">
                        <path id="Icon_ionic-ios-star" data-name="Icon ionic-ios-star" d="M17.463,8.458H12.271L10.693,3.749a.572.572,0,0,0-1.073,0L8.042,8.458H2.815a.566.566,0,0,0-.565.565.415.415,0,0,0,.011.1.543.543,0,0,0,.236.4l4.267,3.007L5.127,17.285a.566.566,0,0,0,.194.635.546.546,0,0,0,.318.138.692.692,0,0,0,.353-.127l4.165-2.968,4.165,2.968a.661.661,0,0,0,.353.127.507.507,0,0,0,.314-.138.559.559,0,0,0,.194-.635l-1.638-4.761,4.232-3.035.1-.088a.54.54,0,0,0-.416-.942Z" transform="translate(-2.25 -3.375)" fill="currentColor"/>
                    </svg>
                </div>

            </div>

            <div class="form-group flex-shrink max-w-full px-4 w-full mb-4">
                <label for="feedback_content" class="font-bold inline-block mb-2">{{ __('Write you thoughts') }}</label>
                <textarea id="feedback_content" name="feedback_content" rows="8" class="w-full leading-5 relative py-3 px-3 rounded-lg text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" ></textarea>
            </div>

            <div class="form-group flex-shrink max-w-full px-4 w-full">
                <x-button label="{{ __('Submit') }}" type="submit" id="save_feedback_button" icon="" class="py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent" />
            </div>
        </div>
    </div>

    <style>
        span#course_{{$course->id}}_rating::after {
            width: {{ $rating_progress }};
        }

        span#star_five_rating::after {
            width: 100%;

        }span#star_four_rating::after {
            width: 80%;

        }span#star_three_rating::after {
            width: 60%;

        }span#star_two_rating::after {
            width: 40%;

        }span#star_one_rating::after {
            width: 20%;
        }
    </style>

<div id="toggle_lessons" class="flex justify-end mt-10 hidden" style="position: absolute; top:10px;">
    <button class="bg-gray-800 text-white px-4 py-2 rounded">Lessons</button>
</div>

<div id="toggle_lessons" class="flex justify-end mt-10 hidden" style="position: absolute; top:10px;">
    <button class="bg-gray-800 text-white px-4 py-2 rounded">Lessons</button>
</div>

    <script>
        // Get the necessary elements
        const drawerToggle = document.getElementById('drawerToggle');
        const leftDrawer = document.getElementById('leftDrawer');
        const lessonSection = document.getElementById('lesson_section');
        const toggleLessonsButton = document.getElementById('toggle_lessons');

        // Toggle drawer and show/hide the "toggle lessons" button
        drawerToggle.addEventListener('click', function () {
            // Toggle the visibility of the left drawer
            leftDrawer.classList.toggle('hidden');

            // Replace class on lesson section
            if (leftDrawer.classList.contains('hidden')) {
                lessonSection.classList.replace('col-span-7', 'col-span-12');
            } else {
                lessonSection.classList.replace('col-span-12', 'col-span-7');
            }

            // Show the "toggle lessons" button when the drawer is hidden
            if (leftDrawer.classList.contains('hidden')) {
                toggleLessonsButton.classList.remove('hidden'); // Show the button
            } else {
                toggleLessonsButton.classList.add('hidden');   // Hide the button
            }
        });

        // Add event listener for the "toggle lessons" button
        toggleLessonsButton.addEventListener('click', function () {
            // Hide the "toggle lessons" button
            toggleLessonsButton.classList.add('hidden');

            // Show the left drawer and update the lesson section layout
            leftDrawer.classList.remove('hidden');
            lessonSection.classList.replace('col-span-12', 'col-span-7');
        });
    </script>



    <script>
        const getResourcesArray = function(array) {
                return array.split(', ');
            }

        // Function to dynamically create buttons
        function displayAttachmentButtons(attachments) {
            // Get the button container div
            const container = $('#buttonContainer');
            // Clear the container first in case buttons are already there
            container.empty();
            container.addClass('flex flex-wrap gap-1');
            
            // Loop through the attachment array
            attachments.forEach(function(attachment) {
                // Extract the file name from the URL
                const fileNameWithPrefix = attachment.substring(attachment.lastIndexOf('/') + 1);
                const fileNameWithoutPrefix = fileNameWithPrefix.substring(fileNameWithPrefix.indexOf('_') + 1); // Remove prefix before the underscore
                if(attachment !== "") {
                    // Create a button element
                    const button = $('<button></button>')
                        .addClass('flex items-center justify-between px-8 py-3 h-10 bg-gray-100 text-dark text-xs rounded-md grow-0 mr-2 border border-gray-600') // Set styles for the button
                        .html(`<svg xmlns="http://www.w3.org/2000/svg" width="14" height="19" viewBox="1046.218 779.609 14.497 18.933" class="mr-2">
                                <path d="M1046.515 794.992v-3.106c0-.245.2-.444.444-.444h1.479c.244 0 .443.2.443.444v3.106c0 .654.53 1.183 1.184 1.183h7.1c.654 0 1.183-.529 1.183-1.183v-3.106c0-.245.2-.444.444-.444h1.479c.244 0 .443.2.443.444v3.106a3.55 3.55 0 0 1-3.55 3.55h-7.1a3.55 3.55 0 0 1-3.55-3.55Zm7.432-1.738 6.213-6.213c.554-.554.166-1.516-.629-1.516h-3.55v-5.029a.885.885 0 0 0-.887-.887h-3.55a.885.885 0 0 0-.888.887v5.03h-3.55c-.794 0-1.183.96-.628 1.515l6.212 6.213a.895.895 0 0 0 1.257 0Z" fill-rule="evenodd" data-name="Icon awesome-sign-in-alt"/>
                            </svg><p style="font-size:14px">${fileNameWithoutPrefix}</p>`); // Add download icon and text


                    // Add click event to the button for downloading the file
                    button.on('click', function() {
                        // Create a temporary anchor element
                        var a = document.createElement('a');
                        a.href = attachment;  // Set the file URL
                        a.download = fileNameWithoutPrefix;
                        // Append the anchor to the body (necessary to trigger the download in some browsers)
                        document.body.appendChild(a);

                        // Trigger the click event on the anchor to start the download
                        a.click();

                        // Remove the anchor from the DOM after the download starts
                        document.body.removeChild(a);
                    });

                    
                    // Append the button to the container
                    container.append(button);
                }
                
            });
        }

        function setActiveTab(tab) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.classList.add('hidden');
            });

            // Remove active state from all tabs
            document.querySelectorAll('a').forEach(function(tabLink) {
                tabLink.classList.remove('border-green-600');
                tabLink.classList.add('border-transparent');
            });

            // Show the active tab content
            document.getElementById('content-' + tab).classList.remove('hidden');

            // Set the active tab
            const activeTab = document.getElementById('tab-' + tab);
            activeTab.classList.add('border-green-600');
            activeTab.classList.remove('border-transparent');
        }

        // Call this function to set the default tab
        document.addEventListener('DOMContentLoaded', function() {
            setActiveTab('description'); // Set "description" tab as default
        });

        document.addEventListener('DOMContentLoaded', function () {
            var lecturesCountElement = document.getElementById('lectures_count');
            var topicDescriptionElement = document.getElementById('topic_description');
            var topicvideoDurationElement = document.getElementById('topicvideo_duration');
            var topicItems = document.querySelectorAll('.topic-item');

            // Set default values from the first topic on page load
            if (topicItems.length > 0) {
                var firstTopic = topicItems[0];  // Get the first topic item
                var defaultLessonCount = firstTopic.getAttribute('data-lesson-count');
                var defaultTopicDescription = firstTopic.getAttribute('data-topic-description');
                var defaultTopicvideoDuration = firstTopic.getAttribute('data-topicvideo-duration');

                // Set the default values on load
                lecturesCountElement.innerText = defaultLessonCount;
                topicDescriptionElement.innerText = defaultTopicDescription;
                topicvideoDurationElement.innerText = defaultTopicvideoDuration;
            }

            // Add event listener to each topic item in the list
            topicItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    // Get the lesson count from the clicked topic's data attribute
                    var lessonCount = this.getAttribute('data-lesson-count');
                    var topicDescription = this.getAttribute('data-topic-description');
                    var topicvideoDuration = this.getAttribute('data-topicvideo-duration');
                    
                    // Update the lectures count in the 'Lectures' field
                    lecturesCountElement.innerText = lessonCount;
                    topicDescriptionElement.innerText = topicDescription;
                    topicvideoDurationElement.innerText = topicvideoDuration;

                });
            });
        });


    </script>


    <script>
        $(document).ready(function() {
            $('div.flex.flex-row.md\\:font-lg.font-medium.items-center.h-20.text-white.w-full.md\\:h-20.bg-green-700').hide();

            $('aside.w-full.bg-white.beautify-scrollbar.text-black.overflow-scroll')
                .append(`
                    <form id="logout_form" action="{{route('logout')}}" class="block px-4 py-2 flex justify-end" method="POST">
                        @csrf
                        <button name="logout_button" class="flex items-center text-gray-800 hover:bg-gray-200">
                            <i class="fas fa-sign-out-alt mr-2"></i> <!-- FontAwesome logout icon -->
                            {{ __('Logout') }}
                        </button>
                    </form>
                `);

            

            if ($('button#sub_try_again_button').length > 0) {
                $('li.quiz-item').removeClass('quiz-item hover:bg-gray-200 hover:rounded-2xl');
            }

            if ( ! $('div#lesson_quiz_section').hasClass('hidden') ) {
                const lesson_obj = $('li.lesson-item:first').find('a');
                $('div#quiz_section').addClass('hidden');
                // $('div#lesson_section h1#lesson_title').html($(lesson_obj).html());
                $('div#lesson_section div#lesson_content').html($(lesson_obj).data('content'));
                $('div#lesson_section iframe#lesson_video').attr('src', $(lesson_obj).data('video-url'));
                $('div#lesson_section div#lesson_description').html($('h2#course_description').val());
                // Call the function with the attachment array
                displayAttachmentButtons(getResourcesArray($(lesson_obj).data('attachment-file')));
                // console.log(getResourcesArray($(lesson_obj).data('attachment-file')));
                // debugger
            }

            // clicked a lesson
            $('li.lesson-item').on('click', function() {
                const lesson_obj = $(this).find('a');
                $('div#quiz_section').addClass('hidden');
                $('div#lesson_section').removeClass('hidden');

                // $('div#lesson_section h1#lesson_title').html($(lesson_obj).html());
                $('div#lesson_section div#lesson_content').html($(lesson_obj).data('content'));
                $('div#lesson_section iframe#lesson_video').attr('src', $(lesson_obj).data('video-url'));
                $('div#lesson_section div#lesson_description').html($('h2#course_description').val());
                displayAttachmentButtons(getResourcesArray($(lesson_obj).data('attachment-file')));

                // console.log($('h2#course_description').val());
                // debugger

                $('li.lesson-item').removeClass('active');
                $('li.quiz-item').removeClass('active');
                $(this).addClass('active');
            });

            // clicked a quiz
            $('body').on('click', 'li.quiz-item', function() {
                const quiz_obj = $(this).find('a');
                $('div#lesson_section').addClass('hidden');
                $('div#quiz_section').removeClass('hidden');

                $('div#quiz_section div#quiz_title').html('Q: ' + $(quiz_obj).html());
                $('div#quiz_section div#quiz_description').html($(quiz_obj).data('description'));

                var quiz_list = '';
                const quizzes = $(quiz_obj).data('question-options');
                const quiz_ids = $(quiz_obj).data('question-option-ids');
                $.each(quizzes, function(index, quiz) {
                    quiz_list += `
                        <li data-question-option-id="${quiz_ids[index]}" class="rounded-3xl border border-gray-300 p-2 mb-3 cursor-pointer hover:bg-purple-100">
                            <div class="flex">
                                <span class="quiz-index rounded-full border w-10 h-10 p-0.5 pt-1.5 text-center border-gray-600">${String.fromCharCode(index + 65)}</span>
                                <span class="ml-5 mt-2">${quiz}</span>
                            </div>
                        </li>`;
                });
                $('div#question_list').html('<ul>' + quiz_list + '</ul>');

                $('li.lesson-item').removeClass('active');
                $('li.quiz-item').removeClass('active');
                $(this).addClass('active');
            });

            // clicked a quiz option
            $('body').on('click', 'div#question_list li', function(event) {
                event.preventDefault();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $(this).find('span.quiz-index').removeClass('border-white').addClass('border-gray-600');
                }
                else {
                    $(this).addClass('active');
                    $(this).find('span.quiz-index').removeClass('border-gray-600').addClass('border-white');
                }

            });

            // next lesson
            $('a#next_lesson').on('click', function() {
                var active_lesson = $('li.lesson-quiz-item.active');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('student.lesson.complete') }}',
                    dataType: 'text',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        course_id: '{{ $course->id }}',
                        lesson_id: $(active_lesson).find('a').data('lesson-id')
                    },
                    success: function(response) {
                        $(active_lesson).addClass('text-green-700');
                        var next_lesson = $(active_lesson).next();
                        if ( ! next_lesson.hasClass('lesson-quiz-item') ) {
                            // if there is no next lesson, close the current accordion and then open the next accordion
                            $(active_lesson).parent().parent().parent().find('div.accordion').hide();
                            $(active_lesson).parent().parent().parent().next().find('div.accordion').show();
                            next_lesson = $(active_lesson).parent().parent().parent().next().find('li.lesson-quiz-item:first');

                            if ( ! next_lesson.hasClass('lesson-quiz-item') ) {
                                $('div#lesson_quiz_section').addClass('hidden');
                                $('div#congratulation_section').removeClass('hidden');
                                $('div#feedback_dialog').removeClass('hidden');
                                $('div#overlay').removeClass('hidden');
                                return;
                            }
                        }
                        if ( ! $(next_lesson).hasClass('lesson-item')) {
                            // if next lesson is not lesson and all lessons was completed, go to first question.
                            if ($('li.lesson-quiz-item.lesson-item').length == $('li.lesson-quiz-item.lesson-item.text-green-700').length)
                                $(next_lesson).addClass('quiz-item hover:bg-gray-200 hover:rounded-2xl');
                        }
                        $(next_lesson).click();
                    },
                    error: function(jq, status, data) {
                        console.log('lesson complete - error: ' + data.toString());
                    }
                })
            });

            // next quiz
            $('a#next_quiz').on('click', function() {
                const active_quiz = $('li.lesson-quiz-item.active');
                const next_quiz = $(active_quiz).next();

                var question_options = [];
                $.each($('div#question_list').find('li'), function(index, question_option) {
                    question_options.push({
                        id: $(question_option).data('question-option-id'),
                        value: $(question_option).hasClass('active') ? 1 : 0
                    })
                });

                const is_latest_question = $(next_quiz).hasClass('lesson-quiz-item') ? 0 : 1
                $.ajax({
                    type: 'POST',
                    url: '{{ route('student.question.complete') }}',
                    dataType: 'text',
                    async: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        course_id: '{{ $course->id }}',
                        question_id: $(active_quiz).find('a').data('question-id'),
                        question_options: question_options,
                        is_latest_question: is_latest_question
                    },
                    success: function(response) {
                        console.log(response);
                        $(active_quiz).addClass('text-green-700');
                        $(next_quiz).addClass('quiz-item hover:bg-gray-200 hover:rounded-2xl');
                        if ( is_latest_question ) {
                            $('div#lesson_quiz_section').addClass('hidden');
                            if (response == 1) {
                                $('div#lesson_quiz_section').addClass('hidden');
                                $('div#congratulation_section').removeClass('hidden');
                                $('div#feedback_dialog').removeClass('hidden');
                                $('div#overlay').removeClass('hidden');
                            }
                            else
                                $('div#bad_luck_section').removeClass('hidden');
                            return;
                        }
                        $(next_quiz).click();
                    },
                    error: function(jq, status, data) {
                        console.log('question complete - error: ' + data.toString());
                    }
                })


            })

            $('button#sub_try_again_button, button#main_try_again_button').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('student.question.clear') }}',
                    dataType: 'text',
                    async: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        course_id: '{{ $course->id }}',
                    },
                    success: function(response) {
                       window.location.reload();
                    },
                    error: function(jq, status, data) {
                        console.log('question clear - error: ' + data.toString());
                    }
                })
            })

            $(".star-icon").click(function() {
                const filled_star_nums = $('.star-icon.filled-star').length;
                $(this).prevAll('.star-icon').removeClass('unfilled-star');
                $(this).prevAll('.star-icon').addClass('filled-star');
                $(this).nextAll('.star-icon').removeClass('filled-star');
                $(this).nextAll('.star-icon').addClass('unfilled-star');

                const clickedStarId = $(this).attr("id");
                if (clickedStarId == 'star-1') {
                    if ($(this).hasClass('filled-star')) {
                        if (filled_star_nums == 1) {
                            $(this).removeClass('filled-star');
                            $(this).addClass('unfilled-star');
                        }
                    }
                    else {
                        $(this).addClass('filled-star');
                        $(this).removeClass('unfilled-star');
                    }
                }
                else {
                    $(this).addClass('filled-star');
                    $(this).removeClass('unfilled-star');
                }

                $('input[name=star_nums]').val($('.star-icon.filled-star').length);

            });

            $('button#close_feedback_dialog').on('click', function() {
                closeFeedbackDialog();
            });

            $('div#overlay').on('click', function() {
                closeFeedbackDialog();
            });

            $('button#save_feedback_button').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('student.feedback.register') }}',
                    dataType: 'text',
                    async: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        course_id: '{{ $course->id }}',
                        star_nums: $('input[name=star_nums]').val(),
                        feedback_content: $('textarea[name=feedback_content]').val()
                    },
                    success: function(response) {
                        closeFeedbackDialog();
                    },
                    error: function(jq, status, data) {
                        console.log('question clear - error: ' + data.toString());
                    }
                })
            })

            function closeFeedbackDialog() {
                $('div#feedback_dialog').addClass('hidden');
                $('div#overlay').addClass('hidden');
            }
        });
    </script>
</div>
