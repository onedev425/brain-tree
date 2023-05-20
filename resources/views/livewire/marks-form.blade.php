<div class="card">
    <div class="card-body">
        @unlessrole(['student'])
        <livewire:datatable :model="App\Models\User::class" uniqueId="students-list-table" :filters="[['name' => 'students'], ['name' => 'orderBy' , 'arguments' => ['name']], ['name' => 'has', 'arguments' => ['StudentRecord']], ['name' => 'with' , 'arguments' => ['studentRecord']]]" :columns="[
                ['property' => 'name', 'type' => 'href', 'links' => 'students.show', 'text'=> 'view', 'class' => 'text-purple-500', 'image' => 'profile_photo_path'],
                ['property' => 'course'],
                ['property' => 'progress'],
                ['property' => 'marks', 'name' => 'Marked Scored'],
                ['property' => 'Actions', 'name' => 'Actions'],
            ]
            "/>
        @endhasanyrole
    </div>
</div>
