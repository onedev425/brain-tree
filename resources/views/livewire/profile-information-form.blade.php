<div class="card">
    <div class="card-body">
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="md:grid grid-cols-12 gap-4">
                <div class="col-span-12 flex flex-col my-2">
                    <label class="font-bold my-3">{{ __('Full name') }} <span class='text-red-500'>*</span></label>
                    <input id="name" name="name" placeholder="{{ __('Your full name') }}" class="border border-gray-500 p-2 rounded bg-inherit w-full" value="{{ auth()->user()->name }}" />
                    @error('name')<span class="text-red-500 font-medium block mt-1.5">{{ $message }}</span>@enderror
                </div>
                <div class="col-span-6 flex flex-col my-2">
                    <label class="font-bold my-3">{{ __('Email') }} <span class='text-red-500'>*</span></label>
                    <input id="email" name="email" placeholder="{{ __('Your email address') }}" class="border border-gray-500 p-2 rounded bg-inherit w-full" value="{{ auth()->user()->email }}" />
                    @error('email')<span class="text-red-500 font-medium block mt-1.5">{{ $message }}</span>@enderror
                </div>

                <div class="col-span-6 flex flex-col my-2">
                    <label class="font-bold my-3">{{ __('Phone number') }} <span class='text-red-500'>*</span></label>
                    <input id="phone" name="phone" placeholder="{{ __('Your phone number') }}" class="border border-gray-500 p-2 rounded bg-inherit w-full" value="{{ auth()->user()->phone }}" />
                    @error('phone')<span class="text-red-500 font-medium block mt-1.5">{{ $message }}</span>@enderror
                </div>

                @if (auth()->user()->hasRole('student'))
                    <div class="col-span-6 flex flex-col my-2">
                        <label class="font-bold my-3">{{ __('Date of Birth') }} <span class='text-red-500'>*</span></label>
                        <input type="date" id="birthday" name="birthday" placeholder="{{ __('Your birthday...') }}" class="border border-gray-500 p-2 rounded bg-inherit w-full" value="{{ auth()->user()->birthday }}" />
                        @error('birthday')<span class="text-red-500 font-medium block mt-1.5">{{ $message }}</span>@enderror
                    </div>
                @endif

                <div class="col-span-6 flex flex-col my-2 hidden">
                    <label class="font-bold my-3">{{ __('Country') }} <span class='text-red-500'>*</span></label>
                    <select id="country" name="country" class="p-2 border rounded-md border-gray-400 focus:border-blue-500 bg-inherit">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" data-iso2="{{ strtolower($country->iso2) }}" {{ $country->id == $user_country_id ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-6 flex flex-col my-2 country-list">
                    <label class="font-bold my-3">{{ __('Country') }} <span class='text-red-500'>*</span></label>
                    <input type="text" id="country-iti" name="country-iti" class="w-full">
                </div>

                <div class="col-span-6 flex flex-col my-2">
                    <label class="font-bold my-3">{{ __('Industry') }} <span class='text-red-500'>*</span></label>
                    <select id="industry" name="industry" class="p-2 border rounded-md border-gray-400 focus:border-blue-500 bg-inherit">
                        @foreach ($industries as $industry)
                            <option value="{{ $industry->id }}" {{ $industry->id == $user_industry_id ? 'selected' : '' }}>{{ $industry->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-6 flex flex-col my-2">
                    <label class="font-bold my-3">{{ __('Language') }} <span class='text-red-500'>*</span></label>
                    <select id="language" name="language" class="p-2 border rounded-md border-gray-400 focus:border-blue-500 bg-inherit">
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}" {{ $language->id == $user_language_id ? 'selected' : '' }}>{{ $language->name }} ({{ $language->name_native }})</option>
                        @endforeach
                    </select>
                </div>

                @if (! auth()->user()->hasRole('student'))
                    <div class="col-span-6 flex flex-col my-2">
                        <label class="font-bold my-3">{{ __('Years of Experience') }} <span class='text-red-500'>*</span></label>
                        <select id="experience" name="experience" class="p-2 border rounded-md border-gray-400 focus:border-blue-500 bg-inherit">
                            @php ($experiences = ['1', '2', '3', '4', '5', '5+'])
                            @foreach ($experiences as $experience)
                                <option value="{{$experience}}" {{ $experience == $user_experience ? 'selected' : '' }}>{{$experience}} {{ $experience == 1 ? __('Year') : __('Years') }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

            </div>
            <x-button type="submit" class="mt-7">{{ __('Save') }}</x-button>
        </form>
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

        iti.setCountry("{{ $user_country_iso2 }}");
        dialCode = document.querySelector('.iti__selected-dial-code');
        dialCode.textContent = '+' + iti.getSelectedCountryData().dialCode + '(' + iti.getSelectedCountryData().name + ')';
    });

</script>
