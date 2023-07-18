<form action="{{ route('login') }}" method="POST" class="w-full">
    <div class="block md:flex -mx-3">
        <div class="w-full md:w-1/2 px-3 mb-3">
            <label for="" class="font-medium px-1 block mb-3">{{ __('Email') }} <span class="text-red-500">*</span></label>
            <div class="block">
                <input type="email" name="email" id="email" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('email') }}">
                @error('email')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-3">
            <label for="" class="font-medium px-1 block mb-3">{{ __('Password') }} <span class="text-red-500">*</span></label>
            <div class="block">
                <input type="password" name="password" id="password" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('password') }}">
                @error('password')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    @csrf
    <div class="flex gap-1 items-center">
        <div class="w-full my-2">
            <x-button class="mt-3 py-3 md:px-10 text-white font-semibold border-transparent">{{ __('Login account') }}</x-button>
        </div>
    </div>
    <div class="flex gap-1 items-center my-4">
        <a href="{{route('password.request')}}" class="text-black block font-semibold underline" aria-label="Forgot Password">{{ __('Forgot your Password?') }}</a>
    </div>
</form>
