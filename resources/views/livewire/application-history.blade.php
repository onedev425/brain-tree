<div>
    @if ($applicant->accountApplication->statuses->isNotEmpty())
        @foreach ($applicant->accountApplication->statuses as $item)
            @if (!$loop->first)
                <div class="m-auto col-md-9">
                    <i class="fas fa-arrow-circle-up fa-2x"></i>
                </div>
            @endif
            <div class="card">
                <div class="card-header text-black">
                    <h4 class="card-title capitalize">{{$item->name}}</h4>
                </div>
                @if ($item->reason != null)
                    <div class="card-body">
                        <p class="text-left">{{$item->reason}}</p>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <p class="text-center">{{ __('No status History') }}</p>
    @endif
</div>
