<div class="card">
    <div class="card-body">
        @unlessrole(['student'])
        <livewire:teacher-list-table uniqueId="teachers-list-table" perPage="10"/>
        @endhasanyrole
    </div>
</div>
