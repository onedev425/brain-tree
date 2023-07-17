<div class="card">
    <div class="card-header">
        <h2 class="card-title">Industries</h2>
    </div>
    <div class="card-body">
        <div class="flex mt-3">
            <a href="{{ route('industry.create') }}" class="bg-red-600 uppercase hover:bg-opacity-90 active:bg-opacity-70 text-white py-2 px-4 border-2 rounded-lg">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('Create new industry') }}
            </a>
        </div>
        <div style="margin-top: -45px">
            <livewire:datatable unique_id="list-industry-table" :model="App\Models\Industry::class"
                                :columns="[
                ['property' => 'name'],
                ['name' => 'Actions', 'type' => 'dropdown' , 'links' => [
                    ['href' => 'industry.edit', 'text' => 'edit', 'icon' => 'fas fa-cog'],
                ]],
                ['type' => 'delete', 'name' => 'Delete', 'action' => 'industry.destroy',]
            ]"/>
        </div>
    </div>
</div>
