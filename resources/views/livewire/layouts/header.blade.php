<header class="w-full">
	<div class="flex md:flex-row flex-col h-40 justify-between w-full md:h-20 bg-white">
		<img src="/images/logo/auth-logo.png" class="md:h-full p-3 h-20 object-contain"/>
		<div class="md:h-full flex flex-row md:font-lg font-bold items-center justify-center h-20">
			<a href="https://braintreespro.com" class="p-3 md:p-5">HOME</a>
			<a href="https://braintreespro.com/home/blogs" class="p-3 md:p-5">BLOGS</a>
			<a href="https://braintreespro.com/home/about-us" class="p-3 md:p-5">ABOUT US</a>
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
	</div>
	@if(auth()->user())
		<div class="shadow-md w-full h-20 lg:pt-32 sm:pt-14 pb-4 border-b-2 {{ auth()->user()->hasRole('student') ? 'bg-purple-600' : 'bg-green-700' }}">
		</div>
	@endif
</header>