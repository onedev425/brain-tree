<div class="card">
    <div class="card-body">
        @unlessrole(['student'])
        <livewire:student-list-table uniqueId="students-list-table" perPage="10"/>
        @endhasanyrole
    </div>
</div>
