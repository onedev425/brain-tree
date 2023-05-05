<div {{ $attributes->merge(['class' => 'md:grid grid-cols-12']) }}>
    <div class="md:col-span-12">
        <div class="card shadow-sm">
            <div class="card-body">
                {{ $content }}
            </div>
        </div>
    </div>
</div>
