<div class="w-full absolute text-center -mt-16 md:hidden">
    <div class="w-12 text-white border border-1 py-1 rounded ml-5">
        <button role="button" class="text-2xl mx-3 text-dark" @click="menuOpen = !menuOpen">
            <p class="sr-only">Menu</p>
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
    </div>
    <div class="w-full text-xl capitalize text-white font-semibold p-3 -mt-12">
        @yield('page_heading')
    </div>
</div>

<nav class="hidden md:block md:sticky inset-0 w-full h-full md:sidebar-expand md:-mt-14 lg:-mt-24 md:ml-10 lg:ml-14 flex duration-250 transition-all z-40" :class="{'d-block absolute' : menuOpen == true}">
    <div class="card mt-0 sm:p-10 md:p-4">
        <div class="card-body">
            <button role="button" class="text-2xl mx-3 text-gray-400 float-right border border-1 rounded-full px-4 py-2 shadow -mt-2 -mr-4 md:hidden" @click="menuOpen = !menuOpen">
                <p class="sr-only">Menu</p>
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
            <aside class="w-full bg-white beautify-scrollbar text-black overflow-scroll">
                <div class="p-3">
                    <div class="text-center mb-10">
                        <img class="w-9/12 rounded-full m-auto bg-gray-700 hidden sm:block mb-5" src="{{ @asset('images/logo/avatar.png') }}" alt="avatar" >
                        <div class="text-4xl font-bold mb-3">{{ auth()->user()->name }}</div>
                        <div class="text-xl">{{ auth()->user()->hasRole('student') ? 'Student' : 'Teacher' }}</div>
                    </div>
                    @isset ($menu)
                        @foreach ($menu as $menuItem)
                            @if (isset($menuItem['header']) & (!isset($menuItem['can']) || auth()->user()->can($menuItem['can'])))
                                <p x-transition class="my-3">{{$menuItem['header']}}</p>
                            @elseif(!isset($menuItem['can']) || auth()->user()->can($menuItem['can']))
                                <div @click.outside="submenu = false" x-data="{
                                    'submenu'  : {{ isset($menuItem['submenu']) && in_array(Route::currentRouteName() , array_column($menuItem['submenu']  , 'route')) ? '1' : '0'}}
                                    }" >
                                    @if (!isset($menuItem['submenu']))
                                        <a  class="flex gap-2 p-3 px-4 my-0 rounded-xl hover:bg-red-100" href="{{route($menuItem['route'])}}"
                                           :class="{'bg-red-700 hover:bg-red-400 hover:bg-opacity-100 text-white' : {{Route::currentRouteName() == $menuItem['route'] || in_array(Route::currentRouteName(), $menuItem['routes']) ? '1' : '0'}}}" aria-label="{{$menuItem['text']}}"
                                            title="{{$menuItem['text']}}"
                                        >
                                        <span class="inline-block w-10">{!! $menuItem['icon'] !!}</span>
                                        <p class="text-lg font-medium">{{$menuItem['text']}}</p>
                                        </a>
                                    @else
                                        <a class="flex items-center justify-between gap-2 p-3 my-2 px-4 rounded hover:bg-white hover:bg-opacity-5"  @click="submenu = !submenu" :class="{'bg-red-600 hover:bg-red-400 hover:bg-opacity-100 text-white' : {{in_array(Route::currentRouteName() , array_column($menuItem['submenu'] , 'route'))  ? '1' : '0'}} }" >
                                            <div class="flex items-center gap-2">
                                                <i class="{{$menuItem['icon'] ?? 'fa fa-circle'}} " aria-hidden="true" x-transition></i>
                                                <p class="cursor-default">{{$menuItem['text']}}</p>
                                            </div>
                                            <i class="transition-all" :class="{'fas fa-angle-left' : submenu == false , 'fas fa-angle-down ' : submenu == true}" ></i>
                                        </a>
                                        @foreach ($menuItem['submenu'] as $submenu)
                                            @if ($submenu['can'] && auth()->user()->can($submenu['can']))
                                                <a class="flex items-center gap-2 p-3 px-4 my-2 transition-all rounded  hover:bg-opacity-5 hover:bg-white whitespace-nowrap" :class="{'h-0 my-auto overflow-hidden py-0' : submenu == false, 'bg-white text-black hover:bg-opacity-100' : {{( Route::currentRouteName() == $submenu['route'] ? '1': '0' )}} }" x-transition href="{{route($submenu['route'])}}"" aria-label="{{$submenu['text']}}" @focus="submenu = true"  @blur="submenu = false">
                                                <i class="{{$submenu['icon'] ?? 'far fa-fw fa-circle'}} " aria-hidden="true"></i>
                                                <p>{{$submenu['text']}}</p>
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        @endforeach

                        <form action="{{route('logout')}}" class="w-full" method="POST">
                            @csrf
                            <button href="" class="flex w-full text-dark gap-2 px-4 mt-7 text-center text-lg font-medium p-3 px-4 my-0 rounded-xl hover:bg-red-100">
                                <svg width="36px" height="36px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 12L13 12" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p class="text-lg px-1">Log out</p>
                            </button>
                        </form>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</nav>
