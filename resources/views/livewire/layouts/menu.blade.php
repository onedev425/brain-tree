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

                        @php( $photo_path = auth()->user()->profile_photo_path)
                        <div class="hidden sm:inline-block image-input image-input-outline {{ strpos($photo_path, 'images/logo/avatar') > 0 || ! $photo_path ? 'image-input-empty' : '' }}" data-kt-image-input="true" style="border-radius: 50%; background-image: url( {{ asset('images/logo/avatar.png') }} )">
                            <input type="hidden" name="use_default_image">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-56 h-56" id="avatar_image_container" style="border-radius: 50%; background-image: url( {{ strpos($photo_path, 'images/logo/avatar') > 0 || ! $photo_path ? '' : $photo_path }})"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon rounded-full hover:text-green-600 w-6 h-6 bg-white shadow" data-kt-image-input-action="change" title="Change company logo" style="left:80%;margin-top:25px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                                <!--begin::Inputs-->
                                <input type="file" name="avatar_image" id="avatar_image_input" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_image_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon rounded-full hover:text-green-600 w-6 h-6 bg-white shadow" data-kt-image-input-action="cancel" title="Cancel company logo" style="left:80%;margin-top:-25px">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                        </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon rounded-full hover:text-green-600 w-6 h-6 bg-white shadow" id="avatar_image_remove" data-kt-image-input-action="remove" title="Remove company logo" style="left:80%;margin-top:-25px">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                        </span>
                            <!--end::Remove-->
                        </div>

                        <div class="text-4xl font-bold mb-3">{{ auth()->user()->name }}</div>
                        <div class="text-xl capitalize">{{ auth()->user()->hasRole('teacher') ? 'Instructor' : auth()->user()->roles[0]->name }}</div>
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
                                           :class="{'bg-red-700 hover:bg-red-400 hover:bg-opacity-100 text-white' : {{Route::currentRouteName() == $menuItem['route'] || in_array(Route::currentRouteName(), $menuItem['sub_routes']) ? '1' : '0'}}}" aria-label="{{$menuItem['text']}}"
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

    <script>
        // handle the image uploading
        const avatarImageInput = document.getElementById('avatar_image_input');
        const avatarImageContainer = document.getElementById('avatar_image_container');
        const avatarImageRemove = document.getElementById('avatar_image_remove');

        avatarImageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imageData = e.target.result;
                    avatarImageContainer.style.backgroundImage = `url(${imageData})`;
                };

                reader.readAsDataURL(file);
                avatarImageContainer.parentNode.classList.remove('image-input-empty');
            }
        });

        avatarImageRemove.addEventListener('click', function() {
            avatarImageContainer.style.backgroundImage = 'none';
            avatarImageContainer.parentNode.classList.add('image-input-empty');

            $.ajax({
                url: '{{ route('user.avatar.remove') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle the server response
                },
                error: function(xhr, status, error) {
                    // Handle the AJAX error
                }
            });
        });

        $(document).on('change', '#avatar_image_input', function(e) {
            e.preventDefault();

            $('input[name=use_default_image]').val(($('div#avatar_image_container').css('background-image') == 'none' || $('div#avatar_image_container').css('background-image') == '') ? 1 : 0);
            var formData = new FormData();
            formData.append('avatar_image', $(this)[0].files[0]);
            formData.append('use_default_image', $('input[name=use_default_image]').val());

            $.ajax({
                url: '{{ route('user.avatar.update') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle the server response
                },
                error: function(xhr, status, error) {
                    // Handle the AJAX error
                }
            });
        });
    </script>
</nav>
