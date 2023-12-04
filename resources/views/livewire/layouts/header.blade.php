<header class="w-full">
	<div class="flex flex-row md:font-lg font-medium items-center h-20 text-white w-full md:h-20 bg-green-700">
		<a href="https://braintreespro.com" class="ml-auto hidden md:flex p-3 md:p-5">HOME</a>
		<a href="https://braintreespro.com/home/about-us" class="p-3 hidden md:flex md:p-5">ABOUT US</a>
		<a href="https://braintreespro.com/home/courses" class="p-3 hidden md:flex md:p-5">COURSES</a>
		<a href="https://braintreespro.com/home/services/" class="p-3 hidden md:flex md:p-5">SERVICES</a>
		<a href="https://braintreespro.com/home/blogs" class="p-3 hidden md:flex md:p-5">BLOGS</a>
		<a href="https://braintreespro.com/home/contact-us" class="p-3 hidden md:flex md:p-5">CONTACT</a>

		@if(auth()->user())
			@php( $photo_path = auth()->user()->profile_photo_path)
			<div x-data="{ open: false }" class="relative mr-5">
				<div @click="open = !open" class="flex items-center cursor-pointer">
					<div class="rounded-full overflow-hidden mr-2">
						<img src="{{ $photo_path == '' ? '/images/logo/avatar.png' : $photo_path }}" alt="Avatar" class="w-8 h-8 object-cover">
					</div>
					<span>{{ auth()->user()->name }}</span>
				</div>

				<div x-show="open" @click.away="open = false" class="absolute z-50 mt-2 right-px w-32 bg-white border rounded shadow-lg">
					<!-- Dropdown items go here -->
					<a href="/dashboard" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">{{ __('Profile') }}</a>
					<a href="/settings" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">{{ __('Settings') }}</a>
					<form id="logout_form" action="{{route('logout')}}" class="block px-4 py-2" method="POST">
							@csrf
							<button name="logout_button" class="text-gray-800 hover:bg-gray-200">
								{{ __('Logout') }}
							</button>
					</form>
				</div>
			</div>
		@endif
	</div>
	@if(auth()->user())
		<div class="shadow-md w-full h-20 lg:pt-32 sm:pt-14 pb-4 border-b-2 {{ auth()->user()->hasRole('student') ? 'bg-purple-600' : 'bg-green-700' }}">
		</div>
	@endif
</header>
