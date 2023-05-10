<div>
    <div class="absolute -mt-20 md:-mt-24 lg:-mt-28 text-center md:text-left w-11/12 md:w-auto">
        <h1 class="text-xl md:text-3xl capitalize text-white font-semibold">{{__('Course')}}</h1>
    </div>
    <div class="block">
        <div class="float-right">
            <x-button class="">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('Create new course') }}
            </x-button>
        </div>
        <div class="card float-left w-full mt-2">
            <div class="card-body">
                <div class="block md:flex mt-4 md:mt-10 border-b-2 border-gray-300">
                    <a href="javascript:;" wire:click="setTab('publish')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'publish' ? 'border-b-4 border-green-600' : '' }}" style="{{ $activeTab === 'publish' ? '' : 'opacity: .5' }}">
                        {{ __('Publish') }} (6)
                    </a>
                    <a href="javascript:;" wire:click="setTab('draft')" class="py-2 px-2 lg:px-4 w-full md:w-1/3 lg:w-1/5 text-center text-black cursor-pointer block font-semibold {{ $activeTab === 'draft' ? 'border-b-4 border-green-600' : '' }}"  style="{{ $activeTab === 'draft' ? '' : 'opacity: .5' }}">
                        {{ __('Draft') }} (2)
                    </a>
                </div>

                <div style="margin-top: 40px">
                    @if ($activeTab === 'publish')
                        <livewire:teacher-course-block />
                    @else
                        <livewire:teacher-course-block />
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
