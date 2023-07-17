<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

class Menu extends Component
{
    public $menu;

    public function mount()
    {
        $this->menu = [
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24.667" height="27.5" viewBox="0 0 24.667 27.5">
                              <g id="Icon_feather-user" data-name="Icon feather-user" transform="translate(-5 -3.5)">
                                <path id="Path_44" data-name="Path 44" d="M28.667,31V28.167A5.667,5.667,0,0,0,23,22.5H11.667A5.667,5.667,0,0,0,6,28.167V31" transform="translate(0 -1)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                <path id="Path_45" data-name="Path 45" d="M23.333,10.167A5.667,5.667,0,1,1,17.667,4.5,5.667,5.667,0,0,1,23.333,10.167Z" transform="translate(-0.333)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                              </g>
                            </svg>',
                'text'  => 'Profile',
                'route' => 'profile.show',
                'sub_routes' => ['profile.show'],
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="30.866" height="27.98" viewBox="0 0 30.866 27.98">
                              <g id="Icon_feather-book-open" data-name="Icon feather-book-open" transform="translate(-2 -3.5)">
                                <path id="Path_46" data-name="Path 46" d="M3,4.5h8.66a5.773,5.773,0,0,1,5.773,5.773V30.48a4.33,4.33,0,0,0-4.33-4.33H3Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                <path id="Path_47" data-name="Path 47" d="M32.433,4.5h-8.66A5.773,5.773,0,0,0,18,10.273V30.48a4.33,4.33,0,0,1,4.33-4.33h10.1Z" transform="translate(-0.567)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                              </g>
                            </svg>',
                'text'  => 'Courses',
                'route' => 'teacher.course.index',
                'sub_routes' => ['teacher.course.index', 'teacher.course.create', 'teacher.course.edit'],
                'can' => 'teacher-courses'
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="30.866" height="27.98" viewBox="0 0 30.866 27.98">
                              <g id="Icon_feather-book-open" data-name="Icon feather-book-open" transform="translate(-2 -3.5)">
                                <path id="Path_46" data-name="Path 46" d="M3,4.5h8.66a5.773,5.773,0,0,1,5.773,5.773V30.48a4.33,4.33,0,0,0-4.33-4.33H3Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                <path id="Path_47" data-name="Path 47" d="M32.433,4.5h-8.66A5.773,5.773,0,0,0,18,10.273V30.48a4.33,4.33,0,0,1,4.33-4.33h10.1Z" transform="translate(-0.567)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                              </g>
                            </svg>',
                'text'  => 'Courses',
                'route' => 'student.course.index',
                'sub_routes' => ['student.course.index', 'student.course.show'],
                'can' => ['student-courses'],
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="30.866" height="29" viewBox="0 0 30.866 29">
                              <path id="Icon_feather-bookmark" data-name="Icon feather-bookmark" d="M36.366,31.5,21.933,24,7.5,31.5V7.5c0-1.657,1.846-3,4.124-3H32.242c2.277,0,4.124,1.343,4.124,3Z" transform="translate(-6.5 -3.5)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>',
                'text'  => 'Certifications & Marks',
                'route' => 'certification.index',
                'sub_routes' => ['certification.index'],
                'can' => 'certification-marks'
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="32pt" height="30pt" viewBox="0 0 235 214">
                                <g transform="translate(0,214) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                                <path d="M722 2120 c-65 -29 -145 -115 -170 -183 -60 -159 12 -338 166 -414 49 -24 69 -28 142 -28 68 0 94 5 131 23 75 37 125 87 161 160 29 58 33 77 33
                                142 -1 59 -6 87 -27 132 -31 67 -99 137 -160 165 -61 29 -216 30 -276 3z m233 -89 c169 -77 183 -314 25 -408 -46 -28 -64 -33 -117 -33 -143 0 -233 90 -233 232 0 101 55 184 145 216 48 17 136 14 180 -7z"/>
                                <path d="M2183 1527 c-60 -68 -133 -153 -163 -190 l-55 -66 -73 0 c-70 -1 -74 -2 -115 -40 -23 -22 -82 -91 -132 -155 -49 -63 -92 -115 -95 -116 -3 0 -31 67
                                -63 149 -45 118 -66 158 -97 190 -77 79 -55 76 -519 79 l-414 3 -54 -26 c-100 -49 -96 -43 -289 -548 -126 -328 -133 -365 -90 -430 38 -56 83 -79 146 -75 87
                                6 141 61 180 181 7 21 14 36 16 34 3 -2 -3 -63 -13 -136 l-17 -131 -92 0 c-115 0 -118 -3 -122 -124 -3 -80 -1 -93 16 -109 18 -17 63 -17 733 -15 l714
                                3 3 110 c3 135 3 135 -120 135 -48 0 -88 2 -88 5 0 8 -30 229 -36 265 l-6 35 31 -42 c53 -74 130 -94 198 -52 52 32 467 556 479 605 6 25 1 78 -11 120 -5
                                17 26 58 154 208 159 185 178 215 149 244 -26 26 -50 9 -155 -111z m-887 -268 c43 -26 38 -16 130 -255 42 -109 82 -205 89 -213 11 -11 35 14 142 150 175
                                223 194 243 236 235 39 -8 57 -30 57 -71 0 -25 -31 -70 -151 -225 -276 -356 -278 -358 -323 -340 -32 12 -35 17 -132 268 -80 207 -103 252 -130 252 -19 0
                                -32 -31 -28 -65 23 -166 94 -723 94 -732 0 -10 -92 -13 -425 -13 l-425 0 5 23 c8 37 95 708 95 737 0 34 -25 58 -47 44 -16 -10 -44 -76 -183 -432 -89 -227
                                -90 -228 -156 -220 -20 2 -33 12 -42 31 -17 35 -17 34 139 439 141 368 136 357 178 385 l34 23 405 0 c393 0 406 -1 438 -21z m204 -1139 l0 -30 -640 0
                                -640 0 0 30 0 30 640 0 640 0 0 -30z"/>
                                </g>
                            </svg>',
                'text'  => 'Instructors',
                'route' => 'teachers.index',
                'sub_routes' => ['teachers.index', 'teachers.show'],
                'can'   => 'read teacher',
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0,512) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                                <path d="M2335 5105 c-273 -42 -517 -172 -708 -375 -210 -223 -319 -481 -334 -790 -21 -432 191 -845 557 -1084 180 -118 353 -178 563 -195 389 -30 721 92
                                989 365 262 267 379 596 347 974 -28 324 -171 603 -419 817 -196 168 -376 252 -625 288 -120 17 -260 18 -370 0z m426 -314 c157 -40 275 -109 407 -236 172
                                -163 259 -343 282 -576 27 -276 -58 -528 -245 -728 -116 -124 -287 -229 -432 -266 -215 -54 -471 -31 -655 60 -251 124 -437 356 -505 630 -26 105 -23 342 6
                                450 77 290 329 559 609 650 152 49 379 56 533 16z"/>
                                <path d="M1427 2639 c-153 -16 -311 -74 -436 -158 -312 -212 -514 -686 -561 -1316 -26 -354 -5 -529 86 -712 50 -102 145 -214 242 -286 74 -54 198 -110
                                307 -138 l90 -24 1400 0 1400 0 90 23 c316 83 537 296 616 597 41 155 36 525 -12 817 -105 650 -371 1040 -792 1162 -96 28 -268 49 -319 39 -49 -9 -117 -45
                                -271 -144 -166 -107 -192 -121 -316 -166 -146 -53 -255 -74 -390 -74 -140 0 -248 20 -390 70 -134 48 -140 51 -350 184 -110 70 -192 115 -224 124 -56 14
                                -56 14 -170 2z m260 -395 c188 -121 267 -160 432 -214 430 -141 869 -73 1283 198 187 123 183 121 262 111 363 -46 590 -351 686 -924 39 -236 51 -565 25
                                -690 -42 -201 -178 -343 -386 -402 -60 -17 -139 -18 -1434 -18 -1298 0 -1373 1 -1435 18 -149 42 -278 144 -338 267 -52 106 -65 195 -57 410 7 217 17 318
                                52 495 26 138 87 334 130 419 129 256 304 396 531 425 37 5 71 9 75 10 4 0 82 -47 174 -105z"/>
                                </g>
                                </svg>',
                'text'  => 'Students',
                'route' => 'students.index',
                'sub_routes' => ['students.index', 'students.show'],
                'can'   => 'read student',
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="30.299" height="30.306" viewBox="0 0 30.299 30.306">
                              <path id="Icon_ionic-ios-pricetag" data-name="Icon ionic-ios-pricetag" d="M29.553,3.375H21.244a.978.978,0,0,0-.69.284L3.943,20.27a1.951,1.951,0,0,0,0,2.752l7.91,7.91a1.951,1.951,0,0,0,2.752,0l16.6-16.6a.978.978,0,0,0,.284-.69V5.322A1.938,1.938,0,0,0,29.553,3.375Zm-3.225,7.559A2.163,2.163,0,1,1,28.241,9.02,2.165,2.165,0,0,1,26.328,10.934Z" transform="translate(-2.194 -2.375)" fill="none" stroke="currentColor" stroke-width="2"/>
                            </svg>',
                'text'  => 'Pricing',
                'route' => 'pricing.index',
                'sub_routes' => ['pricing.index'],
                'can' => 'pricing'
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="32.118" height="32.118" viewBox="0 0 32.118 32.118">
                              <g id="Icon_feather-settings" data-name="Icon feather-settings" transform="translate(-0.5 -0.5)">
                                <path id="Path_40" data-name="Path 40" d="M21.714,17.607A4.107,4.107,0,1,1,17.607,13.5,4.107,4.107,0,0,1,21.714,17.607Z" transform="translate(-1.048 -1.048)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                <path id="Path_41" data-name="Path 41" d="M26.69,20.666a2.259,2.259,0,0,0,.452,2.492l.082.082a2.74,2.74,0,1,1-3.874,3.874l-.082-.082a2.277,2.277,0,0,0-3.861,1.615v.233a2.738,2.738,0,0,1-5.476,0v-.123a2.259,2.259,0,0,0-1.479-2.067,2.259,2.259,0,0,0-2.492.452l-.082.082A2.74,2.74,0,1,1,6,23.349l.082-.082a2.277,2.277,0,0,0-1.615-3.861H4.238a2.738,2.738,0,1,1,0-5.476h.123a2.259,2.259,0,0,0,2.067-1.479A2.259,2.259,0,0,0,5.977,9.96l-.082-.082A2.74,2.74,0,1,1,9.769,6l.082.082a2.259,2.259,0,0,0,2.492.452h.11a2.259,2.259,0,0,0,1.369-2.067V4.238a2.738,2.738,0,1,1,5.476,0v.123a2.277,2.277,0,0,0,3.861,1.615l.082-.082a2.74,2.74,0,1,1,3.874,3.874l-.082.082a2.259,2.259,0,0,0-.452,2.492v.11a2.259,2.259,0,0,0,2.067,1.369h.233a2.738,2.738,0,0,1,0,5.476h-.123a2.259,2.259,0,0,0-2.067,1.369Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                              </g>
                            </svg>',
                'text'  => 'Security & Settings',
                'route' => 'settings.index',
                'sub_routes' => ['settings.index'],
                'can' => 'settings'
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Industries',
                'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" x="0" y="0" viewBox="0 0 512 512" class="">
                                <g>
                                    <path d="M209.067 341.333h-34.133a8.533 8.533 0 0 0 0 17.066h34.133a8.533 8.533 0 0 0 0-17.066zM209.067 375.467h-34.133a8.533 8.533 0 0 0 0 17.066h34.133a8.533 8.533 0 0 0 0-17.066zM209.067 409.6h-34.133a8.533 8.533 0 0 0 0 17.066h34.133a8.533 8.533 0 0 0 0-17.066zM209.067 443.733h-34.133a8.533 8.533 0 0 0 0 17.066h34.133a8.533 8.533 0 0 0 0-17.066z" fill="currentColor" data-original="#000000" class=""></path>
                                    <path d="m484.86 198.547-19.794 18.38v-71.86h8.533a8.533 8.533 0 0 0 8.533-8.533V102.4a8.533 8.533 0 0 0-8.533-8.533h-85.333a8.533 8.533 0 0 0-8.533 8.533v34.133a8.533 8.533 0 0 0 8.533 8.533h8.533v135.25l-17.067 15.848V204.8c0-7.451-8.88-11.323-14.34-6.253l-62.46 57.999V145.067h8.533a8.533 8.533 0 0 0 8.533-8.533V102.4a8.533 8.533 0 0 0-8.533-8.533h-102.4a8.533 8.533 0 0 0-8.533 8.533v34.133a8.533 8.533 0 0 0 8.533 8.533h8.533v79.784l-76.8 71.314V204.8c0-6.941-7.845-10.978-13.493-6.944l-20.64 14.743v-67.532h8.533a8.533 8.533 0 0 0 8.533-8.533V102.4a8.533 8.533 0 0 0-8.533-8.533H29.867a8.533 8.533 0 0 0-8.533 8.533v34.133a8.533 8.533 0 0 0 8.533 8.533H38.4V261.36L7.84 283.19a8.532 8.532 0 0 0-3.573 6.944v213.333A8.533 8.533 0 0 0 12.8 512h477.867a8.533 8.533 0 0 0 8.533-8.533V204.8c0-7.451-8.88-11.323-14.34-6.253zm-88.06-87.614h68.267V128H396.8v-17.067zm17.067 153.534V145.069H448v87.705l-34.133 31.693zM38.4 110.933h68.267V128H38.4v-17.067zm179.2 0h85.333V128H217.6v-17.067zm17.067 34.134h51.2v127.325l-25.6 23.772V204.8c0-.466-.035-.917-.101-1.354a8.324 8.324 0 0 0-.476-1.725 8.293 8.293 0 0 0-1.649-2.694c-.036-.039-.08-.071-.117-.11a8.604 8.604 0 0 0-1.726-1.392c-.15-.091-.312-.16-.467-.242a8.792 8.792 0 0 0-1.704-.704c-.06-.017-.122-.023-.182-.038a8.632 8.632 0 0 0-2.173-.29c-.145 0-.291.024-.437.032-.255.013-.51.018-.764.056a8.264 8.264 0 0 0-1.839.516 8.324 8.324 0 0 0-1.644.847c-.161.109-.311.25-.467.373-.199.156-.403.297-.594.474l-11.26 10.456v-63.938zm-179.2.001H89.6v79.722l-4.249 3.035-29.884 21.346V145.068zm426.666 349.865h-460.8V294.525l30.54-21.814.02-.012 42.675-30.484 29.164-20.832v94.351c0 7.451 8.88 11.323 14.34 6.253l93.848-87.145.019-.015 11.26-10.457v91.363c0 .931.139 1.807.392 2.616a8.22 8.22 0 0 0 1.416 2.636c1.632 2.068 4.166 3.301 6.786 3.299.489 0 .979-.059 1.467-.146a8.359 8.359 0 0 0 2.74-1.029 8.74 8.74 0 0 0 1.538-1.122l105.127-97.618v91.365c0 7.451 8.88 11.323 14.34 6.253l84.085-78.079 1.248-1.159.001-.001 19.793-18.379v270.564z" fill="currentColor" data-original="#000000" class=""></path>
                                    <path d="M89.6 341.333H55.467a8.533 8.533 0 0 0 0 17.066H89.6c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533zM89.6 375.467H55.467a8.533 8.533 0 0 0 0 17.066H89.6c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533zM89.6 409.6H55.467a8.533 8.533 0 0 0 0 17.066H89.6c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533zM89.6 443.733H55.467a8.533 8.533 0 0 0 0 17.066H89.6a8.533 8.533 0 0 0 0-17.066zM328.533 341.333H294.4a8.533 8.533 0 0 0 0 17.066h34.133c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533zM328.533 375.467H294.4a8.533 8.533 0 0 0 0 17.066h34.133c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533zM328.533 409.6H294.4a8.533 8.533 0 0 0 0 17.066h34.133c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533zM328.533 443.733H294.4a8.533 8.533 0 0 0 0 17.066h34.133a8.533 8.533 0 0 0 0-17.066zM448 341.333h-34.133a8.533 8.533 0 0 0 0 17.066H448c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533zM448 375.467h-34.133a8.533 8.533 0 0 0 0 17.066H448c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533zM448 409.6h-34.133a8.533 8.533 0 0 0 0 17.066H448c4.713 0 8.533-3.82 8.533-8.533s-3.82-8.533-8.533-8.533zM448 443.733h-34.133a8.533 8.533 0 0 0 0 17.066H448a8.533 8.533 0 0 0 0-17.066zM72.533 76.8a8.533 8.533 0 0 0 8.533-8.533c0-9.367 7.7-17.067 17.067-17.067h34.133c14.099 0 25.6-11.5 25.6-25.6 0-14.099-11.5-25.6-25.6-25.6H98.133C93.42 0 89.6 3.82 89.6 8.533s3.82 8.533 8.533 8.533h34.133c4.674 0 8.533 3.859 8.533 8.533 0 4.674-3.859 8.533-8.533 8.533H98.133C79.341 34.133 64 49.474 64 68.267a8.534 8.534 0 0 0 8.533 8.533zM260.267 76.8a8.533 8.533 0 0 0 8.533-8.533c0-9.367 7.7-17.067 17.067-17.067H320c14.099 0 25.6-11.5 25.6-25.6C345.6 11.5 334.1 0 320 0h-34.133c-4.713 0-8.533 3.82-8.533 8.533s3.82 8.533 8.533 8.533H320c4.674 0 8.533 3.859 8.533 8.533 0 4.674-3.859 8.533-8.533 8.533h-34.133c-18.793 0-34.133 15.34-34.133 34.133a8.533 8.533 0 0 0 8.533 8.535zM482.133 0h-25.6a8.533 8.533 0 0 0 0 17.066h25.6c4.674 0 8.533 3.859 8.533 8.533 0 4.674-3.859 8.533-8.533 8.533h-25.6c-18.793 0-34.133 15.34-34.133 34.133 0 4.713 3.82 8.533 8.533 8.533s8.533-3.82 8.533-8.533c0-9.367 7.7-17.067 17.067-17.067h25.6c14.099 0 25.6-11.5 25.6-25.6 0-14.098-11.5-25.598-25.6-25.598z" fill="currentColor" data-original="#000000" class=""></path>
                                </g>
                            </svg>',
                'route' => 'industry.index',
                'sub_routes' => ['industry.index'],
                'can'     => 'menu-industry',
            ],
            [
                'type'    => 'menu-item',
                'text'    => 'Account Applications',
                'icon'    => '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0,512) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                                <path d="M1145 4631 c-340 -56 -624 -276 -753 -586 -50 -120 -66 -212 -66 -365 0 -156 13 -227 60 -349 140 -354 493 -604 856 -606 82 0 100 3 124 21 53 39 69 71 69 134 0 44 -5 66 -21 86 -39 52 -67 66 -156 74 -116 11 -172 26
                                -253 65 -95 47 -154 92 -216 167 -212 255 -195 623 40 859 200 199 483 244 740 117 72 -35 102 -58 182 -139 76 -77 105 -99 133 -104 131 -25 233 97 182 219 -8 18 -44 66 -82 105 -184 195 -406 297 -669 306 -66 2 -142 0 -170 -4z"/>
                                <path d="M3698 4630 c-135 -21 -275 -77 -394 -155 -89 -60 -228 -198 -250 -250 -51 -123 50 -245 182 -220 28 5 57 27 133 104 80 81 110 104 182 139 258 127 542 82 741 -119 248 -251 250 -642 6 -892 -119 -121 -245 -179 -425 -196
                                -100 -9 -127 -21 -167 -75 -29 -39 -29 -133 0 -172 45 -61 67 -69 177 -68 405 4 782 310 887 720 66 259 12 557 -141 780 -126 183 -335 328 -557 385 -89 22 -287 33 -374 19z"/>
                                <path d="M2393 3985 c-201 -36 -383 -134 -524 -282 -120 -126 -203 -277 -246 -449 -24 -95 -24 -333 0 -428 89 -356 354 -626 706 -717 109 -29 274 -35 387 -15 380 66 672 336 776 715 31 110 31 352 0 462 -103 377 -397 649 -769 714
                                -102 18 -232 18 -330 0z m302 -320 c238 -50 440 -252 490 -490 95 -454 -307 -856 -759 -760 -290 61 -506 328 -506 625 0 237 141 465 350 569 139 68 279 87 425 56z"/>
                                <path d="M1140 2554 c-19 -3 -71 -12 -115 -21 -570 -112 -1014 -635 -1019 -1200 -1 -121 6 -141 68 -187 27 -21 38 -21 566 -21 528 0 539 0 566 21 53 39 69 71 69 134 0 63 -16 95 -69 134 -27 20 -41 21 -451 24 l-423 3 14 59 c69
                                296 293 557 575 669 102 41 187 60 315 70 112 8 136 19 178 75 29 39 29 133 0 172 -42 57 -69 69 -157 70 -45 1 -98 0 -117 -2z"/>
                                <path d="M3775 2547 c-95 -44 -124 -170 -58 -248 35 -41 79 -59 146 -59 81 0 215 -26 310 -60 290 -105 530 -376 601 -677 l14 -62 -423 -3 c-410 -3 -424 -4 -451 -24 -53 -39 -69 -71 -69 -134 0 -63 16 -95 69 -134 27 -21 38 -21 566
                                -21 528 0 539 0 566 21 62 46 69 66 68 187 -5 500 -353 975 -844 1152 -168 60 -428 93 -495 62z"/>
                                <path d="M2420 1914 c-201 -26 -408 -102 -565 -207 -83 -56 -108 -77 -203 -170 -225 -222 -363 -540 -366 -844 -1 -121 6 -141 68 -187 27 -21 31 -21 1206 -21 1175 0 1179 0 1206 21 62 46 69 66 68 187 -4 437 -279 874 -681 1080
                                -189 97 -341 136 -553 141 -80 2 -161 2 -180 0z m303 -329 c374 -65 685 -357 771 -723 l14 -62 -948 0 -948 0 14 60 c39 170 138 343 265 466 225 217 529 312 832 259z"/>
                                </g>
                            </svg>',
                'route' => 'account-applications.index',
                'sub_routes' => ['account-applications.index'],
                'can'     => 'menu-account-application',
            ],








//            [
//                'type'  => 'menu-item',
//                'icon'  => 'fas fa-tachometer-alt',
//                'text'  => 'Dashboard',
//                'route' => 'dashboard',
//            ],
//            ['header' => 'Manage Profile'],
//            [
//                'type'  => 'menu-item',
//                'icon'  => 'fas fa-user',
//                'text'  => 'User Profile',
//                'route' => 'profile.show',
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Students',
//                'icon'    => 'fas fa-user',
//                'can'     => 'menu-student',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View students',
//                        'route' => 'students.index',
//                        'can'   => 'read student',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create student',
//                        'route' => 'students.create',
//                        'can'   => 'create student',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Graduate students',
//                        'route' => 'students.graduate',
//                        'can'   => 'graduate student',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Manage graduations',
//                        'route' => 'students.graduations',
//                        'can'   => 'view graduations',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Teachers',
//                'icon'    => 'fas fa-user',
//                'can'     => 'menu-teacher',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View teachers',
//                        'route' => 'teachers.index',
//                        'can'   => 'read teacher',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create teacher',
//                        'route' => 'teachers.create',
//                        'can'   => 'create teacher',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Fees',
//                'icon'    => 'fas fa-dollar',
//                'can'     => 'menu-fee',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View Fee Invoices',
//                        'route' => 'fee-invoices.index',
//                        'can'   => 'read fee invoice',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Fee Invoice',
//                        'route' => 'fee-invoices.create',
//                        'can'   => 'create fee invoice',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View Fees',
//                        'route' => 'fees.index',
//                        'can'   => 'read fee',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Fee',
//                        'route' => 'fees.create',
//                        'can'   => 'create fee',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View Fee Categories',
//                        'route' => 'fee-categories.index',
//                        'can'   => 'read fee category',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Fee Category',
//                        'route' => 'fee-categories.create',
//                        'can'   => 'create fee category',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Subjects',
//                'icon'    => 'fas fa-lightbulb',
//                'can'     => 'menu-subject',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View subjects',
//                        'route' => 'subjects.index',
//                        'can'   => 'read subject',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create subject',
//                        'route' => 'subjects.create',
//                        'can'   => 'create subject',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Assign teacher to subjects',
//                        'route' => 'subjects.assign-teacher',
//                        'can'   => 'update subject',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Notices',
//                'icon'    => 'fas fa-bell',
//                'can'     => 'menu-notice',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View notices',
//                        'route' => 'notices.index',
//                        'can'   => 'read notice',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create notice',
//                        'route' => 'notices.create',
//                        'can'   => 'create notice',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Exams',
//                'icon'    => 'fas fa-book-open',
//                'can'     => 'menu-exam',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View Exams',
//                        'route' => 'exams.index',
//                        'can'   => 'read exam',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Exam',
//                        'route' => 'exams.create',
//                        'can'   => 'create exam',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Manage Exam records',
//                        'route' => 'exam-records.index',
//                        'can'   => 'update exam record',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Exam tabulation sheet',
//                        'route' => 'exams.tabulation',
//                        'can'   => 'read exam',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Result Checker',
//                        'route' => 'exams.result-checker',
//                        'can'   => 'check result',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Grade Systems',
//                'icon'    => 'fa fa-graduation-cap',
//                'can'     => 'menu-grade-system',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View Grading System',
//                        'route' => 'grade-systems.index',
//                        'can'   => 'read grade system',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Grades',
//                        'route' => 'grade-systems.create',
//                        'can'   => 'create grade system',
//                    ],
//                ],
//            ],
//            [
//                'type'  => 'menu-item',
//                'text'  => 'View Logs',
//                'route' => 'blv.index',
//                'icon'  => 'fa fa-sticky-note',
//                //this menu item checks with roles for now so this prevents other non super users from viewing menu item
//                'can' => 'view logs',
//            ],
        ];
    }

    public function render()
    {
        return view('livewire.layouts.menu');
    }
}
