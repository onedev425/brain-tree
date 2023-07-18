<div>
    @if ($connection_date != '')
        <p>{{ __('Your paypal account connected successfully at') }} {{ date('m-d-Y', strtotime($connection_date)) }}.</p>
    @else
        @if ($error_message != '')
            <p class="text-red-700 font-bold">{{ __('The action you took failed.') }}</p>
            <p class="text-sm mb-7">{{ $error_message }}</p>
        @endif

        <a href="{{ route('paypal.connect') }}" class="my-3 py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent">{{ __('Connect to PayPal') }}</a>
    @endif
</div>
