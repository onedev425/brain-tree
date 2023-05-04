<header class="shadow-md lg:h-56 sm:h-24 h-20 w-full flex justify-between items-end py-2 border-b-2 {{ auth()->user()->hasRole('student') ? 'bg-purple-600' : 'bg-green-700' }}">
	<h1 class="text-3xl pl-96 xl:ml-20 lg:ml-8 md:ml-2 mb-10 my-2 capitalize text-white font-semibold">@yield('page_heading')</h1>
</header>
