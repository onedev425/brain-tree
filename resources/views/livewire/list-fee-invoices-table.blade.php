<div class="card">
    <div class="card-header">
        <h2 class="card-title">Fee Invoices</h2>
    </div>
    <div class="card-body">
        <form action="" class="my-5 md:grid grid-cols-2 gap-4">
            <x-input-year id="year" name="year" label="Due Date Year" wire:model="year"/>
            <x-select name="" wire:model="status" id="invoice-status" group-class="" label="Invoice status" >
                @foreach ($statuses as $status)
                    <option value="{{$status}}">{{ucfirst($status)}}</option>
                @endforeach
            </x-select>
        </form>
        <x-loading-spinner/>

        <div wire:loading.remove.delay class="my-3">
            @unlessrole(['student'])
                <livewire:datatable :model="App\Models\FeeInvoice::class"
                :wire:key="Str::Random(10)"
                uniqueId="list-fee-invoices"
                :filters="array_merge([
                    ['name' => 'whereYear', 'arguments' => ['due_date', $year]],
                    ['name' => 'orderBy', 'arguments' => ['due_date', 'desc']]
                ], $queryAddon)"
                :columns="[
                    ['property' => 'name',],
                    ['name' => 'Student\'s Name', 'property' => 'name', 'relation' => 'user'],
                    ['name' => 'paid'],
                    ['property'=>'balance'],
                    ['property' => 'due_date'],
                    ['name' => 'Actions', 'type' => 'dropdown' , 'links' => [
                        ['href' => 'fee-invoices.edit', 'text' => 'edit', 'icon' => 'fas fa-cog'],
                        ['href' => 'fee-invoices.show', 'text' => 'view', 'icon' => 'fas fa-eye'],
                        ['href' => 'fee-invoices.pay', 'text' => 'Add Payment   ', 'icon' => 'fas fa-money-check-alt'],
                    ]],
                    ['type' => 'delete', 'name' => 'Delete', 'action' => 'fee-invoices.destroy',]
                ]"
                />
            @endunlessrole
            @role('student')
                <livewire:datatable :model="App\Models\FeeInvoice::class"
                :wire:key="Str::Random(10)"
                uniqueId="list-fee-invoices"
                :filters="array_merge([
                    ['name' => 'whereRelation', 'arguments' => ['user', 'id', auth()->user()->id]],
                    ['name' => 'whereYear', 'arguments' => ['due_date', $year]],
                    ['name' => 'orderBy', 'arguments' => ['due_date', 'desc']]
                ], $queryAddon)"
                :columns="[
                    ['property' => 'name',],
                    ['name' => 'paid'],
                    ['property'=>'balance'],
                    ['property' => 'due_date'],
                    ['name' => 'Actions', 'type' => 'dropdown' , 'links' => [
                        ['href' => 'fee-invoices.show', 'text' => 'view', 'icon' => 'fas fa-eye'],
                    ]],
                ]"
                />
            @endrole
        </div>

    </div>
</div>
