<div class="p-5 border rounded-lg block lg:flex justify-between mb-7">
    <div class="">
        <div class="text-xs mt-2">{{ $teacher }}</div>
        <div class="text-lg font-bold text-gray-800 mt-4">{{ $course_title }}</div>
        <div class="flex mt-3">
            {{ $marks }} / {{ $course_points }}
        </div>
        <div class="flex mt-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="16.365" height="16.365" viewBox="0 0 16.365 16.365">
                <g id="Icon_ionic-ios-checkmark-circle-outline" data-name="Icon ionic-ios-checkmark-circle-outline" transform="translate(-3.375 -3.375)">
                    <path id="Path_52" data-name="Path 52" d="M18.861,12.966l-.692-.712a.149.149,0,0,0-.11-.047h0a.143.143,0,0,0-.11.047l-4.8,4.835L11.4,15.342a.152.152,0,0,0-.22,0l-.7.7a.157.157,0,0,0,0,.224l2.2,2.2a.7.7,0,0,0,.46.224.73.73,0,0,0,.456-.216h0l5.26-5.287A.168.168,0,0,0,18.861,12.966Z" transform="translate(-3.11 -3.89)" fill="#1ddc72"/>
                    <path id="Path_53" data-name="Path 53" d="M11.558,4.477A7.078,7.078,0,1,1,6.55,6.55a7.034,7.034,0,0,1,5.008-2.073m0-1.1a8.183,8.183,0,1,0,8.183,8.183,8.181,8.181,0,0,0-8.183-8.183Z" fill="#1ddc72"/>
                </g>
            </svg>
            <span class="text-xs ml-2">{{ __('Completed') }} | {{ substr($completed_date, 0, 10) }} {{ $started_date }}</span>
        </div>
    </div>
    <div class="flex flex-col justify-center">
        <a href="{{ route('certification.download', 'id=' . urlencode(base64_encode(date('s:i:H Y-m-d') . '&' . $course_id))) }}" class="py-2 md:px-5 bg-red-700 rounded text-white font-semibold border-transparent" >{{ __('Download Certificate') }}</a>
    </div>
</div>
