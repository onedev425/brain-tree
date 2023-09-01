<div class="flex w-full relative">
    <x-loading-spinner/>
    <div class="card w-3/5 ml-auto relative overflow-hidden">
        <div class="w-full absolute top-0 left-0 right-0 text-center p-4 bg-red-500 text-2xl font-bold text-white" >{{ __('Information') }}</div>
        <div class="card-body pt-10 w-full h-full flex flex-col">
            <span class="text-2xl font-bold">{{ $course->title }}</span>
            <div class="w-full text-lg pt-4 pb-4">
                {{ $course->description }}
            </div>
            <div class="w-full flex flex-col mt-auto">
                <h3 class="text-xl md:text-2xl font-bold mb-4">
                    {{ __('Course Contents') }}
                </h3>
                <div id="topic_list" x-data="{selected:0}">
                    @foreach($topics as $topic)
                        @php $uuid = Illuminate\Support\Str::uuid()->toString() @endphp
                        <div class="relative flex flex-wrap flex-col shadow mb-4 bg-white">
                            <a href="javascript:;" class="flex border-b border-gray-200 mb-0 bg-gray-100 py-2 px-4 w-full rounded leading-5 font-medium flex focus:outline-none focus:ring-0" @click="selected !== '{{ $uuid }}' ? selected = '{{ $uuid }}' : selected = null">
                                <span class="mr-3">
                                    <svg class="transform transition duration-500 -rotate-180" :class="{ '-rotate-180': selected == '{{ $uuid }}' }" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span class="topic_info" data-uuid="{{ $uuid }}">{!! $topic['title'] !!}</span>
                            </a>
                            <div x-show="selected == '{{ $uuid }}'" class="flex-1 py-4 px-7">
                                @foreach($topic['lessons'] as $lesson_title)
                                    <div class="flex pt-4 justify-between">
                                        <div class="lesson_info pt-1.5" data-uuid="{{ $uuid }}">{{ $lesson_title }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="card w-1/4 ml-12 mr-auto p-4">
        <div class="card-body flex flex-col">
            <img src="{{ $course->image }}" class="rounded-lg"/>
            <span class="mt-4 text-2xl font-bold">$ {{ $course->price }}</span>
            <x-button class="flex items-center justify-center !bg-red-500 font-semibold border-transparent" wire:click="buyCourse({{ $course->id }})" >
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="19.514" height="17.346" viewBox="0 0 19.514 17.346">
                    <path id="Icon_awesome-shopping-cart" data-name="Icon awesome-shopping-cart" d="M17.892,10.208l1.6-7.047a.813.813,0,0,0-.793-.993H5.394L5.083.65a.813.813,0,0,0-.8-.65H.813A.813.813,0,0,0,0,.813v.542a.813.813,0,0,0,.813.813H3.181L5.561,13.8a1.9,1.9,0,1,0,2.271.29h7.1a1.9,1.9,0,1,0,2.155-.353l.187-.822a.813.813,0,0,0-.793-.993H7.39l-.222-1.084H17.1A.813.813,0,0,0,17.892,10.208Z" fill="#fff"/>
                </svg>
                {{ __('Buy now') }}
            </x-button>
            <span class="text-sm">{{ __('by ') . $course->assignedTeacher->name }}</span>
            <span class="text-2xl font-bold mt-4 break-words">{{ $course->title }}</span>
            <div class="flex mt-4 items-center">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18.169" height="18.166" viewBox="0 0 18.169 18.166">
                    <path id="Icon_feather-thumbs-up" data-name="Icon feather-thumbs-up" d="M13.161,8.833V5.5A2.52,2.52,0,0,0,10.62,3L7.234,10.5v9.166h9.551a1.686,1.686,0,0,0,1.693-1.417l1.168-7.5a1.648,1.648,0,0,0-.4-1.344,1.705,1.705,0,0,0-1.3-.573ZM7.234,19.665H4.693A1.68,1.68,0,0,1,3,18V12.166A1.68,1.68,0,0,1,4.693,10.5h2.54" transform="translate(-2.25 -2.25)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                </svg>
                <span id="course_{{$course->id}}_rating" class="rating-progress mt-0.5 mr-2"></span>
                <span class="text-sm font-bold px-1 mr-1 h-5">{{ number_format(round($course->rate, 1), 1) }}</span>
                <span class="text-sm font-bold">({{ $course->feedback_nums ? $course->feedback_nums : 0 }} {{ __('reviews') }})</span>
                @php( $course->rating_progress = intval($course->rate / 5 * 100) . '%' ?? 0 )
            </div>
            <div class="flex mt-4 items-center">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="16.775" height="19.824" viewBox="0 0 16.775 19.824">
                    <g id="user_people_person_users_man" data-name="user people person users man" transform="translate(-5 -3)">
                        <path id="路径_21" data-name="路径 21" d="M19.289,16.111a.763.763,0,1,0-1.075,1.083,6.862,6.862,0,0,1,2.036,4.88c0,.93-2.676,2.287-6.862,2.287S6.525,23,6.525,22.074A6.862,6.862,0,0,1,8.53,17.217a.76.76,0,0,0-1.075-1.075A8.326,8.326,0,0,0,5,22.074c0,2.478,4.323,3.812,8.387,3.812s8.387-1.334,8.387-3.812a8.341,8.341,0,0,0-2.486-5.963Z" transform="translate(0 -3.062)"/>
                        <path id="路径_22" data-name="路径 22" d="M14.337,13.675A5.337,5.337,0,1,0,9,8.337,5.337,5.337,0,0,0,14.337,13.675Zm0-9.15a3.812,3.812,0,1,1-3.812,3.812A3.812,3.812,0,0,1,14.337,4.525Z" transform="translate(-0.95)"/>
                    </g>
                </svg>
                <span class="text-sm font-bold">{{ count($course->course_students) . " " . __('students')}}</span>
            </div>
            <div class="flex mt-4 items-center">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="16.633" height="16.637" viewBox="0 0 16.633 16.637">
                    <g id="Icon_ionic-ios-timer" data-name="Icon ionic-ios-timer" transform="translate(-3.938 -3.938)">
                        <path id="路径_23" data-name="路径 23" d="M12.256,20.575A8.319,8.319,0,0,1,6.483,6.267a.668.668,0,1,1,.928.961,6.981,6.981,0,1,0,5.511-1.922v2.6a.67.67,0,1,1-1.339,0v-3.3a.669.669,0,0,1,.67-.67,8.319,8.319,0,0,1,0,16.637Z" transform="translate(0 0)"/>
                        <path id="路径_24" data-name="路径 24" d="M11.912,11.33,16.051,14.3a1.252,1.252,0,1,1-1.456,2.038,1.209,1.209,0,0,1-.291-.291L11.33,11.912a.417.417,0,0,1,.582-.582Z" transform="translate(-2.988 -2.988)"/>
                    </g>
                </svg>
                <span class="text-sm font-bold">{{ $video_duration . " | " . count($lessons) . " " .  __('Lessons') . " | " . count($questions) . " " .  __('Questions')}}</span>
            </div>
        </div>
        
    </div>
</div>
