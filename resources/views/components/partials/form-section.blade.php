@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid grid-rows-1 grid-cols-12 gap-2']) }}>
    <div class="col-span-12 card shadow-sm">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="card-body">
            {{ $form }}
            </div>

            @if (isset($actions))
                <div class="flex justify-start ">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
