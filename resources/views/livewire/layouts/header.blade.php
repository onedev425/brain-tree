<header class="w-full">
		<div class="md:h-full flex flex-row md:font-lg font-medium items-center h-20 text-white w-full md:h-20 bg-green-700">
			<a href="https://braintreespro.com" class="ml-auto p-3 md:p-5">HOME</a>
			<a href="https://braintreespro.com/home/about-us" class="p-3 md:p-5">ABOUT US</a>
			<a href="https://braintreespro.com/home/services" class="p-3 md:p-5">SERVICES</a>
			<a href="https://braintreespro.com/home/blogs" class="p-3 md:p-5">BLOGS</a>
			<a href="https://braintreespro.com/home/contact-us" class="p-3 md:p-5">CONTACT</a>
			@if(auth()->user())
				<form id="logout_form" action="{{route('logout')}}" class="p-3 md:p-5" method="POST">
						@csrf
						<button name="logout_button" class="text-dark gap-2 text-center">
							{{ __('LOGOUT') }}
						</button>
				</form>
			@endif
		</div>
	@if(auth()->user())
		<div class="shadow-md w-full h-20 lg:pt-32 sm:pt-14 pb-4 border-b-2 {{ auth()->user()->hasRole('student') ? 'bg-purple-600' : 'bg-green-700' }}">
		</div>
	@endif
</header>