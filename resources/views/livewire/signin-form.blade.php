<form action="{{ route('login') }}" method="POST" class="w-full">
    <div class="flex -mx-3">
        <div class="w-1/2 px-3 mb-3">
            <label for="" class="text-white font-medium px-1 block mb-3">Email *</label>
            <div class="block">
                <input type="email" name="email" id="email" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('email') }}">
                @error('email')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-1/2 px-3 mb-3">
            <label for="" class="text-white font-medium px-1 block mb-3">Password *</label>
            <div class="block">
                <input type="password" name="password" id="password" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('password') }}">
                @error('password')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>


    <div class="flex">
        <div class="w-1/2 mb-3">
            <label for="remember"></label>
            <div class="my-3">
                <input type="checkbox" id="remember" name="remember">
                <label class="text-white font-medium " for="remember">Remember Me</label>
            </div>
        </div>
        <div class="w-1/2 mb-3 text-right">
            <a href="{{route('password.request')}}" class="text-blue-800 font-medium block mt-3" aria-label="Forgot Password">Forgot your Password?</a>
        </div>
    </div>

    @csrf
    <div class="flex gap-1 items-center">
        <div class="w-full mb-3">
            <x-button class="my-3 py-3 md:px-10 bg-red-700 text-white font-semibold border-transparent text-xs">Login account ></x-button>
        </div>
    </div>
</form>
