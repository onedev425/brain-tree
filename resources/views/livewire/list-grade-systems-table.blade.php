<div class="card">
    <div class="card-header">
        <h4 class="card-title"> Grade systems list</h4>
    </div>
    <div class="card-body">
        @if (!auth()->user()->hasRole('student'))

        @endif
        <x-loading-spinner/>
    </div>
</div>
