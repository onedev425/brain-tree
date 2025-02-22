<div class="card">
    <div class="card-header">
        <h4 class="card-title">Applicants</h4>
    </div>
    <div class="card-body">
        <livewire:datatable :model="App\Models\User::class"
        :filters="[
            ['name' => 'rejectedApplicants'],
        ]"
        :columns="[
            ['property' => 'name'],
            ['type' => 'dropdown', 'name' => 'actions','links' => [
                ['href' => 'account-applications.edit', 'text' => 'Edit profile', 'icon' => 'fas fa-cog'],
                ['href' => 'account-applications.show', 'text' => 'View profile', 'icon' => 'fas fa-eye'],
                ['href' => 'account-applications.change-status', 'text' => 'Make Decision', 'icon' => 'fas fa-balance-scale'],
                ]],
                ['type' => 'delete', 'name' => 'Delete', 'action' => 'account-applications.destroy']
        ]"/>
    </div>
</div>

