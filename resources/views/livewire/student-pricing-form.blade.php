<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Manage Your Billings') }}</h3>
        </div>
        <div class="card-body">
            <div class="block md:flex mt-4 md:mt-10 border-b-2 border-gray-300">
                <a href="javascript:;" wire:click="setTab('buy_course')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/3 xl:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'buy_course' ? 'border-b-2 border-purple-600 ' : '' }}"  style="{{ $activeTab === 'buy_course' ? '' : 'opacity: .5' }}">
                    {{ __('Buy Course') }}
                </a>
                <a href="javascript:;" wire:click="setTab('histories')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/3 xl:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'histories' ? 'border-b-2 border-purple-600 ' : '' }}"  style="{{ $activeTab === 'histories' ? '' : 'opacity: .5' }}">
                    {{ __('Purchase History') }}
                </a>
            </div>

            <div style="margin-top: 40px">
                @if ($activeTab === 'buy_course')
                    <livewire:student-pricing-buy-course />
                @else
                    <livewire:student-pricing-histories />
                @endif
            </div>
        </div>

    </div>
</div>
