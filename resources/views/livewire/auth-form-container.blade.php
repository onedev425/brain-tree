<div class="w-full">
    <div class="max-w-full flex items-center justify-center px-5 py-5">
        <div class="text-gray-500 rounded-3xl w-full overflow-hidden">
            <div class="md:flex w-full py">
                <div class="w-full md:w-full py-6">
                    <div class="flex flex-cols justify-center items-center">
                        <a href="#"><img src="{{@asset('img/logo/login-logo.png')}}" alt="" class="my-4"></a>
                    </div>
                    <div class="flex mt-4">
                        <div class="w-1/2">
                            <a href="{{ route('login') }}" wire:click="setTab('login')" class="py-2 px-4 w-full text-white text-center cursor-pointer block font-semibold {{ $activeTab === 'login' ? 'border-b-2 border-red-500 ' : 'border-b-2 border-gray-300' }}" style="{{ $activeTab === 'login' ? '' : 'opacity: .5' }}">
                                Login
                            </a>
                        </div>
                        <div class="w-1/2">
                            <a href="{{ route('register') }}" wire:click="setTab('register')" class="py-2 px-4 w-full text-white text-center cursor-pointer block font-semibold {{ $activeTab === 'register' ? 'border-b-2 border-red-500 ' : 'border-b-2 border-gray-300' }}"  style="{{ $activeTab === 'register' ? '' : 'opacity: .5' }}">
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
