<div class="card">
   <div class="card-body">
        <div class="flex flex-row justify-between">
            <h3 class="text text-2xl m-2 font-bold">{{ $user->hasRole('student') ? __('Student Info') : __('Instructor Info') }}</h3>
            <a href="{{ $user->hasRole('student') ? route('students.edit', $user->id) : route('teachers.edit', $user->id)}}" class="flex items-center justify-center px-10 text-white rounded-md !bg-red-500 font-semibold border-transparent" >
                {{ __('Edit Profile') }}
            </a>
        </div>
        <div class="flex lg:flex-row flex-col items-center mt-5">
            <div class="flex mt-5">
                <img width="150" height="150" class="rounded-full" src="{{ $user->profile_photo_path }}" onerror="this.src='{{ asset('images/logo/avatar.png') }}'" />
                <div class="flex items-start flex-col lg:w-80 justify-center ml-8">
                    <div class="text-xl">{{ $user->name }}</div>
                    <div>{{ __('Joined on') }} {{ date('F jS Y', strtotime($user->created_at)) }}</div>
                </div>
            </div>
            <div class="flex flex-col w-full lg:w-fit mt-5 lg:mt-0 justify-around ml-5 h-48">
                <div class="flex items-start flex-col h-16 flex-wrap ml-8">
                    <div class="text-xl">{{ __('Email') }}</div>
                    <div>{{ $user->email }}</div>
                </div>
                @if ($user->hasRole('student'))
                    <div class="flex items-start flex-col h-16 flex-wrap ml-8">
                        <div class="text-xl">{{ __('Birthday') }}</div>
                        <div>{{ $user->birthday }}</div>
                    </div>
                @endif
                @if (!$user->hasRole('student'))
                    <div class="flex items-start flex-col h-16 flex-wrap ml-8">
                        <div class="text-xl">{{ __('Skills') }}</div>
                        <div>{{ $user->skills }}</div>
                    </div>
                @endif
            </div>
            <div class="flex flex-col w-full lg:w-fit mt-5 lg:mt-0 justify-around ml-5 h-48">
                 <div class="flex items-start flex-col h-16 flex-wrap ml-8">
                    <div class="text-xl">{{ __('Phone Number') }}</div>
                    <div>{{ $user->phone }}</div>
                </div>
                @if (!$user->hasRole('student'))
                    <div class="flex items-start flex-col h-16 flex-wrap ml-8">
                        <div class="text-xl">{{ __('Experience') }}</div>
                        <div>{{ $user->experience }}</div>
                    </div>
                @endif
            </div>
        </div>
   </div>
</div>
