<div class="card">
    <div class="card-header">
        <h2 class="card-title">Students list</h2>
    </div>
    <div class="card-body">
        <div class="py-3">
            <x-display-validation-errors/>
        </div>
        @unlessrole(['student'])
            <livewire:datatable :model="App\Models\User::class" uniqueId="students-list-table" :filters="[['name' => 'students'], ['name' => 'inSchool'], ['name' => 'orderBy' , 'arguments' => ['name']], ['name' => 'has', 'arguments' => ['StudentRecord']]]" :columns="[
                ['property' => 'name'] , 
                ['property' => 'email'] , 
                ['property' => 'admission_number' ,'relation' => 'studentRecord'] , 
                ['property' => 'locked', 'name' => 'Locked' , 'type' => 'boolean-switch', 'action' => 'user.lock-account', 'field' => 'lock', 'true-statement' => 'Locked', 'false-statement' => 'Unlocked',  'can' => 'lock user'],
                ['type' => 'dropdown', 'name' => 'actions','links' => [
                    ['href' => 'students.edit', 'text' => 'Manage Profile', 'icon' => 'fas fa-pen', 'can' => 'update student'],
                    ['href' => 'students.show', 'text' => 'View', 'icon' => 'fas fa-eye',],
                ]],
                ['type' => 'delete', 'name' => 'Delete', 'action' => 'students.destroy','can' => 'delete student']
            ]
            "/>
        @endhasanyrole
    </div>
</div>
