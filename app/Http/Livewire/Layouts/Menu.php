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
                'text'  => auth()->user()->hasRole('student') ? 'My Account' : 'Instructor Account',
                'route' => 'profile.show',
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
                'route' => 'exams.index',
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="30.866" height="29" viewBox="0 0 30.866 29">
                              <path id="Icon_feather-bookmark" data-name="Icon feather-bookmark" d="M36.366,31.5,21.933,24,7.5,31.5V7.5c0-1.657,1.846-3,4.124-3H32.242c2.277,0,4.124,1.343,4.124,3Z" transform="translate(-6.5 -3.5)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>',
                'text'  => 'Certifications & Marks',
                'route' => 'profile.show',
                'can' => 'certification-marks'
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="26.443" height="31.251" viewBox="0 0 26.443 31.251">
                              <g id="user_people_person_users_man" data-name="user people person users man" transform="translate(-5 -3)">
                                <path id="Path_21" data-name="Path 21" d="M27.525,16.239a1.2,1.2,0,1,0-1.695,1.707,10.818,10.818,0,0,1,3.209,7.693c0,1.466-4.219,3.606-10.818,3.606S7.4,27.1,7.4,25.638a10.818,10.818,0,0,1,3.161-7.656A1.2,1.2,0,0,0,8.87,16.287,13.125,13.125,0,0,0,5,25.638c0,3.906,6.815,6.01,13.222,6.01s13.222-2.1,13.222-6.01a13.149,13.149,0,0,0-3.918-9.4Z" transform="translate(0 2.603)"/>
                                <path id="Path_22" data-name="Path 22" d="M17.414,19.827A8.414,8.414,0,1,0,9,11.414,8.414,8.414,0,0,0,17.414,19.827Zm0-14.424a6.01,6.01,0,1,1-6.01,6.01A6.01,6.01,0,0,1,17.414,5.4Z" transform="translate(0.808 0)"/>
                              </g>
                            </svg>',
                'text'  => 'Students',
                'route' => 'profile.show',
                'can'   => 'read student',
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="25.163" height="30.954" viewBox="0 0 25.163 30.954">
                              <g id="Icon_feather-book" data-name="Icon feather-book" transform="translate(-5 -2)">
                                <path id="Path_58" data-name="Path 58" d="M6,29.119A3.619,3.619,0,0,1,9.619,25.5H29.163" transform="translate(0 -0.785)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                <path id="Path_59" data-name="Path 59" d="M9.619,3H29.163V31.954H9.619A3.619,3.619,0,0,1,6,28.335V6.619A3.619,3.619,0,0,1,9.619,3Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                              </g>
                            </svg>',
                'text'  => 'Assessments',
                'route' => 'profile.show',
                'can'   => 'assessments',
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="30.866" height="29" viewBox="0 0 30.866 29">
                              <path id="Icon_feather-bookmark" data-name="Icon feather-bookmark" d="M36.366,31.5,21.933,24,7.5,31.5V7.5c0-1.657,1.846-3,4.124-3H32.242c2.277,0,4.124,1.343,4.124,3Z" transform="translate(-6.5 -3.5)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>',
                'text'  => 'Marks',
                'route' => 'profile.show',
                'can'   => 'marks',
            ],
            [
                'type'  => 'menu-item',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="30.299" height="30.306" viewBox="0 0 30.299 30.306">
                              <path id="Icon_ionic-ios-pricetag" data-name="Icon ionic-ios-pricetag" d="M29.553,3.375H21.244a.978.978,0,0,0-.69.284L3.943,20.27a1.951,1.951,0,0,0,0,2.752l7.91,7.91a1.951,1.951,0,0,0,2.752,0l16.6-16.6a.978.978,0,0,0,.284-.69V5.322A1.938,1.938,0,0,0,29.553,3.375Zm-3.225,7.559A2.163,2.163,0,1,1,28.241,9.02,2.165,2.165,0,0,1,26.328,10.934Z" transform="translate(-2.194 -2.375)" fill="none" stroke="currentColor" stroke-width="2"/>
                            </svg>',
                'text'  => 'Pricing',
                'route' => 'profile.show',
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
                'route' => 'profile.show',
                'can' => 'settings'
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
//            ['header' => 'Multi Schools Management', 'can' => 'header-schools'],
//            [
//                'type' => 'menu-item',
//                'text' => 'Schools',
//                'icon' => 'fas fa-school',
//                'can'  => 'menu-school',
//
//                'submenu' => [[
//                    'type'  => 'menu-item',
//                    'text'  => 'View Schools',
//                    'route' => 'schools.index',
//                    'can'   => 'read school',
//                ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create School',
//                        'route' => 'schools.create',
//                        'can'   => 'create school',
//                    ],
//                ],
//            ],
//            ['header' => 'Administration', 'can' => 'header-administrate'],
//            [
//                'type'  => 'menu-item',
//                'icon'  => 'fas fa-cog',
//                'text'  => 'School Settings',
//                'route' => 'schools.settings',
//                'can'   => 'manage school settings',
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Classes',
//                'icon'    => 'fas fa-chalkboard',
//                'can'     => 'menu-class',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View Classes',
//                        'route' => 'classes.index',
//                        'can'   => 'read class',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Class',
//                        'route' => 'classes.create',
//                        'can'   => 'create class',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View Class Groups',
//                        'route' => 'class-groups.index',
//                        'can'   => 'read class group',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Class Group',
//                        'route' => 'class-groups.create',
//                        'can'   => 'create class group',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Sections',
//                'icon'    => 'fas fa-landmark',
//                'can'     => 'menu-section',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View sections',
//                        'route' => 'sections.index',
//                        'can'   => 'read section',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create section',
//                        'route' => 'sections.create',
//                        'can'   => 'create section',
//                    ],
//                ],
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
//                        'text'  => 'Promote students',
//                        'route' => 'students.promote',
//                        'can'   => 'promote student',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Manage promotions',
//                        'route' => 'students.promotions',
//                        'can'   => 'read promotion',
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
//                'text'    => 'Account Applications',
//                'icon'    => 'fas fa-plus',
//                'can'     => 'menu-account-application',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View account applications',
//                        'route' => 'account-applications.index',
//                        'can'   => 'read applicant',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View rejected applications',
//                        'route' => 'account-applications.rejected-applications',
//                        'can'   => 'read applicant',
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
//                'text'    => 'Parents',
//                'icon'    => 'fas fa-user',
//                'can'     => 'menu-parent',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View parents',
//                        'route' => 'parents.index',
//                        'can'   => 'read parent',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create parent',
//                        'route' => 'parents.create',
//                        'can'   => 'create parent',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Admins',
//                'icon'    => 'fas fa-user',
//                'can'     => 'menu-admin',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View admins',
//                        'route' => 'admins.index',
//                        'can'   => 'read admin',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create admin',
//                        'route' => 'admins.create',
//                        'can'   => 'create admin',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Academic years',
//                'icon'    => 'fas fa-calendar',
//                'can'     => 'menu-academic-year',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View academic years',
//                        'route' => 'academic-years.index',
//                        'can'   => 'read academic year',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create academic year',
//                        'route' => 'academic-years.create',
//                        'can'   => 'create academic year',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Semesters',
//                'icon'    => 'fas fa-clock',
//                'can'     => 'menu-semester',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View semesters',
//                        'route' => 'semesters.index',
//                        'can'   => 'read semester',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create semester',
//                        'route' => 'semesters.create',
//                        'can'   => 'create semester',
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
//            ['header' => 'Academics', 'can' => 'header-academics'],
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
//                'text'    => 'Syllabi',
//                'icon'    => 'fas fa-list-alt',
//                'can'     => 'menu-syllabus',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View Syllabi',
//                        'route' => 'syllabi.index',
//                        'can'   => 'read syllabus',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Syllabus',
//                        'route' => 'syllabi.create',
//                        'can'   => 'create syllabus',
//                    ],
//                ],
//            ],
//            [
//                'type'    => 'menu-item',
//                'text'    => 'Timetables',
//                'icon'    => 'fas fa-tasks',
//                'can'     => 'menu-timetable',
//                'submenu' => [
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View Timetables',
//                        'route' => 'timetables.index',
//                        'can'   => 'read timetable',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Timetable',
//                        'route' => 'timetables.create',
//                        'can'   => 'create timetable',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'View custom items',
//                        'route' => 'custom-timetable-items.index',
//                        'can'   => 'read custom timetable items',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Create Custom Items',
//                        'route' => 'custom-timetable-items.create',
//                        'can'   => 'create custom timetable items',
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
//                        'text'  => 'Semester Result Sheet',
//                        'route' => 'exams.semester-result-tabulation',
//                        'can'   => 'read exam',
//                    ],
//                    [
//                        'type'  => 'menu-item',
//                        'text'  => 'Academic Year Result Sheet',
//                        'route' => 'exams.academic-year-result-tabulation',
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
