<div class="card">
    <div class="card-header">
        <h4 class="card-title">Graduands in this year</h4>
    </div>
    <div class="card-body">
        <livewire:datatable :model="App\Models\User::class" uniqueId="students-list-table" 
        :filters="[['name' => 'students'], ['name' => 'inSchool'], ['name' => 'orderBy' , 'arguments' => ['name']], ['name' => 'has', 'arguments' => ['graduatedStudentRecord']]]" :columns="[
            ['property' => 'name'] , 
            ['property' => 'email'] , 
            ['property' => 'admission_number' ,'relation' => 'graduatedStudentRecord'] , 
            ['type' => 'dropdown', 'name' => 'actions','links' => [
                ['href' => 'students.edit', 'text' => 'Manage Profile', 'icon' => 'fas fa-pen',],
                ['href' => 'students.show', 'text' => 'View', 'icon' => 'fas fa-eye',  ],
            ]],
            ['type' => 'delete', 'name' => 'Reset', 'action' => 'students.graduations.reset',]
         ]
        "/>
    </div>
</div>
