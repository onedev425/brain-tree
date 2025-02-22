<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth bg-gray-100">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{asset(config('app.favicon'))}}" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/pristinejs@1.1.0/dist/pristine.min.js"></script>
        <style>
            span.rating-progress::before {
                background-image: url('/images/rating-background.svg');
            }
            span.rating-progress::after {
                background-image: url('/images/rating-foreground.svg');
                margin-top: -14px;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <title>
            @yield('title', config('app.name', 'Braintree'))
        </title>
        @vite('resources/css/app.css')
        <livewire:styles />
    </head>
    <body class="font-sans">
        <a href="#main" class="sr-only">
            Skip to content
        </a>
        <div x-data="{ menuOpen: window.innerWidth >=  1024 ? $persist(false) : false }">
            <livewire:layouts.header/>
            <div class="lg:flex lg:flex-cols text-gray-900 bg-gray-100" >
                <livewire:layouts.menu />
                <div class="w-full">
                    <div class="hidden truncate text-xl uppercase text-white font-semibold p-3 lg:px-8 lg:text-2xl lg:-mt-16 lg:block lg:text-3xl lg:-mt-20">
                        @yield('page_heading')
                    </div>
                    <div class="beautify-scrollbar lg:mt-1 lg:mt-3">
                        <main class="p-3 lg:px-8 lg:py-4" id="main">
                            @yield('content')
                        </main>
                    </div>
                </div>

            </div>
        </div>
    @livewire('display-status')
    </body>
    <livewire:scripts />
    @vite(['resources/js/app.js'])
    @stack('scripts')
</html>
