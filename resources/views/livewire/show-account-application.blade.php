@livewire('show-user-profile', ['user' => $applicant])

<div class="card">
    <div class="card-body">
        <div class="w-full md:w-8/12 m-auto">
            <h4 class="text text-xl mb-4">Applicant apply for :</h4>
            <div class="flex flex-row items-center">
                <h4 class="text text-xl w-40">Position :</h4>
                <span>{{ucfirst($applicant->accountApplication->role->name)}}</span>
            </div>
            <div class="flex flex-row items-center">
                <h4 class="text text-xl w-40">Course Status :</h4>
                <span>{{$applicant->accountApplication->status}}</span>
            </div>
        </div>
    </div>
</div>
