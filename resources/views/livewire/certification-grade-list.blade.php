<div>
    <h3 class="py-4 text text-2xl m-2 font-bold">{{ __('Grades') }}</h3>
    <div class="overflow-x-scroll beautify-scrollbar text-center my-4 border rounded-lg">
        <table class="w-full table-auto">
            <thead class="">
            <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Course') }}</th>
            <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Progress') }}</th>
            <th class="capitalize p-4 whitespace-nowrap font-normal text-left">{{ __('Scored') }}</th>
            </thead>
            <tbody class="">
            @foreach($all_courses as $student_course)
                <tr class="border-t">
                    <td class="p-4 whitespace-nowrap text-start">{{ $student_course->course->title }}</td>
                    <td class="p-4 whitespace-nowrap text-start">{{ $this->getStudentCourseProgressPercent($student_course->course, $student) }}%</td>
                    <td class="p-4 whitespace-nowrap text-start">{{ $this->getPointsOfStudentExam($student_course->course, $student) }} / {{ $this->getCourseTotalPoints($student_course->course) }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
