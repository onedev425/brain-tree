<form action="{{ route('register') }}" method="POST" class="w-full">

    <div class="block md:flex">
        <div class="w-full md:w-1/2 px-3 mb-3">
            <label for="" class="font-medium px-1 block mb-3">{{ __('Full name') }} <span class="text-red-500">*</span></label>
            <div class="block">
                <input type="text" name="user_name" id="user_name" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('user_name') }}">
                @error('user_name')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-3">
            <label for="" class="font-medium px-1 block mb-3">{{ __('Email') }} <span class="text-red-500">*</span></label>
            <div class="block">
                <input type="email" name="email" id="email" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('email') }}">
                @error('email')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
    <div class="block md:flex mt-4">
        <div class="w-full md:w-1/2 px-3 mb-3">
            <label for="" class="font-medium px-1 block mb-3">{{ __('Password') }} <span class="text-red-500">*</span></label>
            <div class="block">
                <input type="password" name="password" id="password" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('password') }}">
                @error('password')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-3">
            <label for="" class="font-medium px-1 block mb-3">{{ __('Confirm password') }} <span class="text-red-500">*</span></label>
            <div class="block">
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('password_confirmation') }}">
                @error('password_confirmation')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="mb-3 px-3 pt-3">
        <div>{{ __('Register As,') }}</div>
        <div class="inline-flex space-x-4">
            <label class="py-4 rounded-lg flex items-center">
                <input type="radio" name="role" class="form-radio h-4 w-4 text-blue-600" value="3" {{ old('role') == 3 ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">{{ __('Student') }}</span>
            </label>
            <label class="py-4 rounded-lg flex items-center">
                <input type="radio" name="role" class="form-radio h-4 w-4 text-blue-600" value="2" {{ old('role') == 2 || old('role') == '' ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">{{ __('Instructor') }}</span>
            </label>

        </div>
    </div>

    @csrf
    <div class="flex gap-1 items-center">
        <div class="w-full px-3 mb-3">
            <x-button type="submit" class="my-3 py-3 md:px-10 text-white font-semibold border-transparent">{{ __('Register an account') }}</x-button>
        </div>
    </div>

</form>

