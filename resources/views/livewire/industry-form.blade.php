<div class="card">
    <div class="card-header">
        <h2 class="card-titile">{{ $industry->name ? __('Edit Category') : __('Create Category') }}</h2>
    </div>
    <div class="card-body">
        <form action="{{ $industry->name ? route('industry.update', $industry->id) : route('industry.store') }}" method="POST" enctype="multipart/form-data" class="md:w-6/12">
            @csrf
            @if($industry->name)
                @method('PUT')
            @endif
            <x-display-validation-errors/>
            <x-input id="name" name="name" label="Name" placeholder="Industry Name" wire:model="state.industry_name" minlength="3" maxlength="100"/>
            <x-button label="{{ __('Submit') }}" theme="primary" icon="" type="submit" class="w-full md:w-1/2"/>
        </form>
    </div>
</div>
