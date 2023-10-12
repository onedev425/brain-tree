<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Manage Your Billings') }}</h3>
        </div>
        <div class="card-body">
            <div class="block md:flex mt-4 md:mt-10 border-b-2 border-gray-300">
                <a href="javascript:;" wire:click="setTab('purchase_histories')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/3 xl:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'purchase_histories' ? 'border-b-2 border-purple-600 ' : '' }}"  style="{{ $activeTab === 'purchase_histories' ? '' : 'opacity: .5' }}">
                    {{ __('Purchase History') }}
                </a>
                <a href="javascript:;" wire:click="setTab('payout')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/3 xl:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'payout' ? 'border-b-2 border-purple-600 ' : '' }}"  style="{{ $activeTab === 'payout' ? '' : 'opacity: .5' }}">
                    {{ __('Payout to Teacher') }}
                </a>
                <a href="javascript:;" wire:click="setTab('payout_histories')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/3 xl:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'payout_histories' ? 'border-b-2 border-purple-600 ' : '' }}"  style="{{ $activeTab === 'payout_histories' ? '' : 'opacity: .5' }}">
                    {{ __('Payout History') }}
                </a>
            </div>

            <div style="margin-top: 40px">
                @if ($activeTab === 'purchase_histories')
                    <livewire:teacher-pricing-histories />
                @elseif ($activeTab == 'payout')
                    <livewire:admin-payout />
                @else
                    <livewire:admin-payout-histories />
                @endif
            </div>
        </div>

    </div>
</div>
