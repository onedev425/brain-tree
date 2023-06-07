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
                'sub_routes' => ['teacher.course.index', 'teacher.course.create'],
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
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="30.866" height="29" viewBox="0 0 30.866 29">
                              <path id="Icon_feather-bookmark" data-name="Icon feather-bookmark" d="M36.366,31.5,21.933,24,7.5,31.5V7.5c0-1.657,1.846-3,4.124-3H32.242c2.277,0,4.124,1.343,4.124,3Z" transform="translate(-6.5 -3.5)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>',
                'text'  => 'Marks',
                'route' => 'marks.index',
                'sub_routes' => ['marks.index'],
                'can'   => 'marks',
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
