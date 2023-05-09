<div class="w-full">
    <div class="max-w-full flex items-center justify-center px-5">
        <div class="text-gray-500 rounded-3xl w-full overflow-hidden">
            <div class="md:flex w-full py">
                <div class="w-full md:w-full px-4 sm:px-8 md:px-16 pt-3 pb-10">
                    <div class="flex flex-cols justify-center items-center">
                        <a href="#"><img src="{{asset(config('app.logo'))}}" alt="" class="my-4"></a>
                    </div>
                    <div class="flex mt-4">
                        <div class="w-1/2">
                            <a href="{{ route('login') }}" wire:click="setTab('login')" class="py-2 px-4 w-full text-center cursor-pointer block text-black font-semibold {{ $activeTab === 'login' ? 'border-b-2 border-red-500 ' : 'border-b-2 border-gray-300' }}" style="{{ $activeTab === 'login' ? '' : 'opacity: .5' }}">
                                Login
                            </a>
                        </div>
                        <div class="w-1/2">
                            <a href="{{ route('register') }}" wire:click="setTab('register')" class="py-2 px-4 w-full text-center cursor-pointer text-black block font-semibold {{ $activeTab === 'register' ? 'border-b-2 border-red-500 ' : 'border-b-2 border-gray-300' }}"  style="{{ $activeTab === 'register' ? '' : 'opacity: .5' }}">
                                Register
                            </a>
                        </div>
                    </div>

                    <div style="margin-top: 40px">
                        @if($activeTab === 'login')
                            <livewire:auth-signin-form />
                        @else
                            <livewire:auth-registration-form />
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
