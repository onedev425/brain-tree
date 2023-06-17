<div class="card">
    <div class="card-body">
        @unlessrole(['student'])
        <livewire:marks-table uniqueId="marks-table" perPage="10"/>
        @endhasanyrole
    </div>
</div>
