<div>
    <livewire:show-user-profile :user="$student" />

    <div class="card">
        <div class="card-body">
            <div class="w-full md:w-8/12 m-auto">
                <h4 class="text text-xl m-2">Student information</h4>
                <x-show-table :body="[
                    ['Admission Number' , $studentRecord->admission_number],
                    ['Admission Date' , $studentRecord->admission_date],
                    ['Graduated' , $studentRecord->is_graduated  ? 'Graduated' : 'Not Graduated'],
                ]"/>
            </div>
        </div>
    </div>
</div>
