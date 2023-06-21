<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Manage Your Billings') }}</h3>
        </div>
        <div class="card-body">
            <div class="block md:flex mt-4 md:mt-10 border-b-2 border-gray-300">
                <a href="javascript:;" wire:click="setTab('histories')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/3 xl:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'histories' ? 'border-b-2 border-purple-600 ' : '' }}"  style="{{ $activeTab === 'histories' ? '' : 'opacity: .5' }}">
                    {{ __('Purchase History') }}
                </a>
                <a href="javascript:;" wire:click="setTab('payment_method')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/3 xl:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'payment_method' ? 'border-b-2 border-purple-600 ' : '' }}"  style="{{ $activeTab === 'payment_method' ? '' : 'opacity: .5' }}">
                    {{ __('Payment Methods') }}
                </a>
            </div>

            <div style="margin-top: 40px">
                @if ($activeTab === 'histories')
                    <livewire:teacher-pricing-histories />
                @else
                    <livewire:teacher-pricing-payment-method />
                @endif
            </div>
        </div>

    </div>
</div>
