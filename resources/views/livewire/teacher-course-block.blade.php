<div class="flex flex-col bg-white mb-12 md:mb-0 rounded-2xl border overflow-hidden">
    <div class="relative border-b">
        <a href="#">
            <div class="absolute inset-0 hover:bg-white opacity-0 transition duration-700 hover:opacity-10"></div>
            <img class="w-full h-48 object-cover" src="{{ $image }}" alt="alt title">
        </a>
    </div>
    <div class="p-4 flex-1">
        <div class="mb-2">
            <span class="text-xs">{{ $created_at }}</span>
        </div>
        <div class="">
            <h3 class="text-lg leading-normal mb-3 font-bold text-gray-800 dark:text-gray-300">
                <a href="#" class="hover:text-indigo-700">{{ $title }}</a>
            </h3>
            <div class="text-gray-500">
                <svg class="bi bi-calendar ltr:mr-2 rtl:ml-2 inline-block" xmlns="http://www.w3.org/2000/svg" width="12.997" height="15" viewBox="0 0 14.997 15">
                    <g id="Icon_ionic-ios-timer" data-name="Icon ionic-ios-timer" transform="translate(-3.938 -3.938)">
                        <path id="Path_23" data-name="Path 23" d="M11.438,18.938a7.5,7.5,0,0,1-5.205-12.9.6.6,0,1,1,.836.866,6.294,6.294,0,1,0,4.969-1.733V7.519a.6.6,0,0,1-1.208,0V4.541a.6.6,0,0,1,.6-.6,7.5,7.5,0,0,1,0,15Z" transform="translate(0 0)" fill="#6c6c6c"/>
                        <path id="Path_24" data-name="Path 24" d="M11.847,11.322,15.579,14a1.129,1.129,0,1,1-1.313,1.838A1.09,1.09,0,0,1,14,15.578l-2.681-3.731a.376.376,0,0,1,.525-.525Z" transform="translate(-3.413 -3.413)" fill="#6c6c6c"/>
                    </g>
                </svg><span class="ml-2 text-xs">{{ $duration }}</span>
            </div>
        </div>
    </div>
    <div class="border-t pl-4 py-2">
        <div class="flex flex-row justify-between">
            <div class="flex flex-col">
                <h3 class="text-base">Price: ${{ $price }}</h3>
            </div>
            <div class="flex">
                <a href="#" class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.906" height="18.906" viewBox="0 0 18.906 18.906">
                        <g id="Icon_feather-edit" data-name="Icon feather-edit" transform="translate(-2 -1.818)">
                            <path id="Path_56" data-name="Path 56" d="M10.562,6H4.68A1.68,1.68,0,0,0,3,7.68V19.443a1.68,1.68,0,0,0,1.68,1.68H16.443a1.68,1.68,0,0,0,1.68-1.68V13.562" transform="translate(0 -1.4)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            <path id="Path_57" data-name="Path 57" d="M20.822,3.34a1.782,1.782,0,1,1,2.521,2.521l-7.982,7.982L12,14.683l.84-3.361Z" transform="translate(-3.959)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </g>
                    </svg>
                </a>
                <div x-data="{ open: false }" class="relative mr-4">
                    <button @click="open = ! open" class="text-gray-500 hover:text-gray-600 dark:hover:text-gray-400 transition-colors duration-200 focus:outline-none hover:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="4" height="18" viewBox="0 0 4 18">
                            <g id="Group_281" data-name="Group 281" transform="translate(-953 -528)">
                                <g id="Ellipse_43" data-name="Ellipse 43" transform="translate(953 528)" stroke="#111" stroke-width="1">
                                    <circle cx="2" cy="2" r="2" stroke="none"/>
                                    <circle cx="2" cy="2" r="1.5" fill="none"/>
                                </g>
                                <g id="Ellipse_44" data-name="Ellipse 44" transform="translate(953 535)" stroke="#111" stroke-width="1">
                                    <circle cx="2" cy="2" r="2" stroke="none"/>
                                    <circle cx="2" cy="2" r="1.5" fill="none"/>
                                </g>
                                <g id="Ellipse_45" data-name="Ellipse 45" transform="translate(953 542)" stroke="#111" stroke-width="1">
                                    <circle cx="2" cy="2" r="2" stroke="none"/>
                                    <circle cx="2" cy="2" r="1.5" fill="none"/>
                                </g>
                            </g>
                        </svg>

                    </button>
                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute rounded-xl bg-white py-2 pl-4 z-10" style="min-width: 10rem; display: none; right:0; box-shadow: 0px 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 50px -6px rgb(0 0 0 / 0.1);">
                        <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900" href="#">Unpublish</a>
                        <a class="block px-3 py-2 hover:bg-gray-100 focus:bg-gray-100 dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:focus:bg-gray-900" href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div><!-- end card -->

