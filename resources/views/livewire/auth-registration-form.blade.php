<form action="{{ route('register') }}" method="POST" class="w-full">

    <div class="block md:flex">
        <div class="w-full px-3">
            <label for="" class="font-medium px-1 block mb-1">{{ __('Full name') }} <span class="text-red-500">*</span></label>
            <div class="block">
                <input type="text" name="user_name" id="user_name" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('user_name') }}">
                @error('user_name')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="block md:flex mt-4">
        <div class="w-full md:w-1/2 px-3">
            <label for="" class="font-medium px-1 block mb-1">{{ __('Email') }} <span class="text-red-500">*</span></label>
            <div class="block">
                <input type="email" name="email" id="email" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('email') }}">
                @error('email')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full md:w-1/2 px-3">
            <label class="font-medium px-1 block mb-1">{{ __('Phone number') }}</label>
            <input id="phone" name="phone" placeholder="{{ __('Your phone number') }}" class="border border-gray-500 p-2 rounded bg-inherit w-full" value="{{ old('phone') }}" />
            @error('phone')<span class="text-red-500 font-medium block mt-1.5">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="block md:flex mt-4">
        <div class="w-full md:w-1/2 px-3">
            <label for="" class="font-medium px-1 block mb-1">{{ __('Password') }} <span class="text-red-500">*</span></label>
            <div class="block relative">
                <input type="password" name="password" id="password" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('password') }}">
                <span class="toggle-password absolute cursor-pointer"><i class="fa fa-eye"></i></span>
                @error('password')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full md:w-1/2 px-3">
            <label for="" class="font-medium px-1 block mb-1">{{ __('Confirm password') }} <span class="text-red-500">*</span></label>
            <div class="block relative">
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full pl-2 pr-3 py-2 rounded border-2 text-black focus:border-indigo-500" placeholder="" value="{{ old('password_confirmation') }}">
                <span class="toggle-password absolute cursor-pointer"><i class="fa fa-eye"></i></span>
                @error('password_confirmation')<span class="text-red-700 font-medium block mt-1.5">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="md:grid grid-cols-12 gap-4 mt-4">
        <div class="col-span-6 flex flex-col px-3 hidden">
            <label class="font-medium block px-1 mb-1">{{ __('Country') }} <span class='text-red-500'>*</span></label>
            <select id="country" name="country" class="w-full p-2 border rounded-md border-gray-400 focus:border-blue-500 bg-inherit">
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" data-iso2="{{ strtolower($country->iso2) }}" {{ $country->id == $default_country_id ? 'selected' : '' }}>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-6 flex flex-col px-3 country-list {{ old('role') == 3 ? 'hidden' : '' }}">
            <label class="font-medium block px-1 mb-1">{{ __('Country') }} <span class='text-red-500'>*</span></label>
            <input type="text" id="country-iti" name="country-iti" class="w-full">
        </div>
        <div class="col-span-6 flex flex-col px-3 category-section {{ old('role') == 3 ? 'hidden' : '' }}">
            <label class="font-medium block px-1 mb-1">{{ __('Category') }} <span class='text-red-500'>*</span></label>
            <select id="industry" name="industry" class="w-full p-2 border rounded-md border-gray-400 focus:border-blue-500 bg-inherit">
                @foreach ($industries as $industry)
                    <option value="{{ $industry->id }}" {{ $industry->id == $default_industry_id ? 'selected' : '' }}>{{ $industry->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-span-6 flex flex-col px-3 language-section {{ old('role') == 3 ? 'hidden' : '' }}">
            <label class="font-medium block px-1 mb-1">{{ __('Language') }} <span class='text-red-500'>*</span></label>
            <select id="language" name="language" class="w-full p-2 border rounded-md border-gray-400 focus:border-blue-500 bg-inherit">
                @foreach ($languages as $language)
                    <option value="{{ $language->id }}" {{ $language->id == $default_language_id ? 'selected' : '' }}>{{ $language->name }} ({{ $language->name_native }})</option>
                @endforeach
            </select>
        </div>

        <div class="col-span-6 flex flex-col px-3 mb-7 experience-section {{ old('role') == 3 ? 'hidden' : '' }}">
            <label class="font-medium block px-1 mb-1">{{ __('Years of Experience') }} <span class='text-red-500'>*</span></label>
            <select id="experience" name="experience" class="w-full p-2 border rounded-md border-gray-400 focus:border-blue-500 bg-inherit">
                @php ($experiences = ['1', '2', '3', '4', '5', '5+'])
                @foreach ($experiences as $experience)
                    <option value="{{$experience}}">{{$experience}} {{ $experience == 1 ? __('Year') : __('Years') }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-3 px-3 pt-3">
        <div>{{ __('Register As,') }}</div>
        <div class="inline-flex space-x-4">
            <label class="py-4 rounded-lg flex items-center">
                <input type="radio" name="role" id="opt_studio" class="form-radio h-4 w-4 text-blue-600" value="3" {{ old('role') == 3 ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">{{ __('Student') }}</span>
            </label>
            <label class="py-4 rounded-lg flex items-center">
                <input type="radio" name="role" id="opt_instructor" class="form-radio h-4 w-4 text-blue-600" value="2" {{ old('role') == 2 || old('role') == '' ? 'checked' : '' }}>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <style>
        .country-list .iti {
            height: 2.75rem;
            font-size: .875rem;
            width: 100%;
            color: #3d3358;
        }
        .country-list .iti__flag-container {
            width: 100%;
        }
        .country-list .iti__selected-flag {
            padding: 15px 19px;
            background: #f5f2f8 !important;
            height: 2.75rem;
            border: 1px solid #d7cce4;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            top: -1px;
        }
        .iti__flag {
            display: inline-block;
        }
        .country-list .iti__selected-dial-code, .country-list .iti__selected-flag {
            background-color: rgba(0,0,0,0);
        }

        .country-list .iti__selected-dial-code {
            white-space: nowrap;
            text-overflow: ellipsis;
            width: 100%;
        }
        .country-list .iti__selected-dial-code {
            overflow: hidden;
        }
        .country-list .iti__arrow {
            right: 16px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
        }
        .country-list .iti__arrow {
            border: 0;
            width: 14px;
            height: 14px;
            background: url('/images/caret-down.png') center no-repeat;
            margin-top: 10px;
        }
        .country-list .iti__country-list {
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            width: auto;
            top: 49px;
        }
        .country-list .iti__country {
            font-size: 12px;
            padding: 6px 15px;
        }
        .country-list .iti input {
            display: none;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        $(document).ready(function() {
            var input = document.querySelector("#country-iti");
            var iti = window.intlTelInput(input, {
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            input.addEventListener("countrychange", function(e) {
                e.preventDefault();
                dialCode = this.parentNode.querySelector('.iti__selected-dial-code');
                dialCode.textContent = '+' + iti.getSelectedCountryData().dialCode + '(' + iti.getSelectedCountryData().name + ')';

                document.querySelectorAll('#country option[selected]').forEach(option => option.removeAttribute('selected'));
                document.querySelector('#country > option[data-iso2="' + iti.getSelectedCountryData().iso2 + '"]').setAttribute('selected', 'selected');

            });

            iti.setCountry("US");
            dialCode = document.querySelector('.iti__selected-dial-code');
            dialCode.textContent = '+' + iti.getSelectedCountryData().dialCode + '(' + iti.getSelectedCountryData().name + ')';

            $('#opt_studio').on('click', function() {
                $('div.birthday-section').removeClass('hidden');
                $('div.experience-section').addClass('hidden');
                $('div.category-section').addClass('hidden');
                $('div.country-list').addClass('hidden');
                $('div.language-section').addClass('hidden');
            })

            $('#opt_instructor').on('click', function() {
                $('div.birthday-section').addClass('hidden');
                $('div.experience-section').removeClass('hidden');
                $('div.category-section').removeClass('hidden');
                $('div.country-list').removeClass('hidden');
                $('div.language-section').removeClass('hidden');
            })
        });

    </script>
</form>

