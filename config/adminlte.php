<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'ArSys V9',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Ar</b>Sys V9',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */


    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-light-cyan elevation-1',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-cyan navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => true,
    'dashboard_url' => 'arsys',
    'logout_url' => 'arsys.logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,


    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        /*
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'pages',
            'url'         => 'admin/pages',
            'icon'        => 'far fa-fw fa-file',
            'label'       => 4,
            'label_color' => 'success',
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ],
        [
            'text'    => 'multilevel',
            'icon'    => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text'    => 'level_one',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'level_two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
        ],
        ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ],
        */

        ['header' => 'Office Administration',
        'roles' => 'admin', 'clerk',
        ],
        [
            'text' => 'Research Assignment',
            'route'  => 'office.letter.research.clerk.assignment',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin', 'clerk', 
        ],
        /*[
            'text' => 'Proposal Seminar',
            'route'  => 'office.clerk.proposal-seminar',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin', 'clerk',
        ],
        
        [
            'text' => 'Timetable',
            'route'  => 'timetable.curriculum.clerk.home',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin', 'clerk',
        ],

        [
            'text' => 'Penelitian',
            'route'  => 'arsys.research.clerk.dashboard-idx',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'clerk',
        ],

        [
            'text' => 'Praktek Industri',
            'route'  => 'timetable.curriculum.clerk.home',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'clerk',
        ],
        */



        ['header' => 'Faculty Page',
        'roles' => 'faculty'
        ],

        [ 'text' =>'My Upcoming Event',
          'route' => 'arsys.event.faculty.upcoming',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'faculty'
        ],


        [ 'text' =>'Events',
          'route' => 'arsys.event.user',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'faculty'
        ],



        [ 'text' =>'Supervision',
          'route' => 'arsys.supervise.faculty',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'faculty'
        ],

        [ 'text' =>'Proposal Review',
          'route' => 'arsys.review.faculty.proposal',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'faculty'
        ],

        [ 'text' =>'Mobile App',
          'route' => 'arsys.user.mobile-activation',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'faculty'
        ],

        ['header' => 'Collaboration',
        'roles' => 'faculty', 'student'
        ],

        [ 'text' =>'Front page',
          'route' => 'collabre.index',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'faculty', 'student'
        ],

        ['header' => 'Lectures',
        'roles' => 'faculty'
        ],

        [ 'text' =>'Schedule',
            'route' => 'timetable.schedule.faculty.lecture',
            'icon'  => 'far fa-fw fa-user',
            'roles' => 'faculty'
        ],



        [
            'text' => 'Presence',
            'route'  => 'lectures.presence',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],


        ['header' => 'ArXiv Documents',
        'roles' => 'faculty'
        ],
        [
            'text' => 'Supervision',
            'route'  => 'arxiv.assignment.faculty.supervision',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],
        [
            'text' => 'Pre-defense Assignment',
            'route'  => 'arxiv.assignment.faculty.pre-defense',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],

        [
            'text' => 'Final-defense Assignment',
            'route'  => 'arxiv.assignment.faculty.final-defense',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],

        [
            'text' => 'Seminar Assignment',
            'route'  => 'arxiv.assignment.faculty.seminar',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],
        [
            'text' => 'Lecture',
            'route'  => 'arxiv.assignment.faculty.lecture',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],

        ['header' => 'ArXiv Management',
        'roles' => 'admin'
        ],
        [
            'text' => 'Final-defense Assignment',
            'route'  => 'arxiv.assignment.admin.final-defense',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],

        [
            'text' => 'Lecture Assignment',
            'route'  => 'arxiv.assignment.admin.lecture',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],


        ['header' => 'Timetable Management',
        'roles' => 'admin'
        ],
        [
            'text' => 'Curriculum',
            'route'  => 'timetable.subject.admin.home',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],
        [
            'text' => 'Schedule',
            'route'  => 'timetable.schedule.admin.home',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],


        [
            'text' => 'FET Export',
            'route'  => 'timetable.fet.admin.home',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],


        ['header' => 'Head of Study Program',
        'roles' => 'program'
        ],

        [ 'text' =>'Event of Final-defense',
          'route' => 'arsys.event.program.upcoming-seminar',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'program'
        ],

        [ 'text' =>'Mark of Pre-defense',
          'route' => 'arsys.defense.program.pre-defense',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'program'
        ],
        [ 'text' =>'Mark of Final-defense',
          'route' => 'arsys.seminar.program.seminar-mark',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'program'
        ],

        [ 'text' =>'Completed Pre-defense',
          'route' => 'arsys.defense.program.pre-defense-all',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'program'
        ],

        [ 'text' => 'Approval of Defense',
          'route' => 'arsys.defense.program.approval',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'program'
        ],

        ['header' => 'Coordinator of Industrial Practic',
        'roles' => 'coordinator'
        ],

        [ 'text' =>'Proposal',
          'route' => 'arsys.review.coordinator.new',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'coordinator'
        ],


        /*['header' => 'Assignment ArXiv',

        'roles' => 'faculty'
        ],
        [
            'text' => 'Defense',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],

        [
            'text' => 'Lectures',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],
        */


        /*['header' => 'Research ArXiv',

        'roles' => 'faculty'
        ],
        [
            'text' => 'Intelectual Property',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],

        [
            'text' => 'Article',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],

        [
            'text' => 'Research Report',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'faculty',
        ],
        */

        





        ['header' => 'Student Page',
        'roles' => 'student'
        ],

        [ 'text' =>'My Profile',
          'route' => 'arsys.profile.student',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'student'
        ],

        [ 'text' =>'Research',
          'route' => 'arsys.research.student',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'student'
        ],

        [ 'text' =>'Upcoming Event',
          'route' => 'arsys.event.user',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'student'
        ],

        [ 'text' =>'Mobile Activation',
          'route' => 'arsys.user.mobile-activation',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'student',
        ],

        [ 'text' =>'Refresh Login',
          'route' => 'arsys.user.refresh-login',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'student'
        ],

        ['header' => 'Lectures',
        'roles' => 'student'
        ],

        [ 'text' =>'Schedule',
            'route' => 'timetable.schedule.student.lecture',
            'icon'  => 'far fa-fw fa-user',
            'roles' => 'student'
        ],


        ['header' => 'Administration',

        'roles' => 'admin'
        ],


        /*[ 'text' =>'Send Message',
          'route' => 'arsys.notification.admin',
          'icon'  => 'far fa-fw fa-paper-plane',
          'roles' => 'admin'
        ],
        */

        [ 'text' =>'User Management',
          'route' => 'arsys.user.management',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'admin'
        ],

        [ 'text' =>'Duty of Faculty',
          'route' => 'arsys.profile.admin.faculty-duty',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'admin'
        ],

        [ 'text'  => 'System Config',
          'route' => 'arsys.config.admin.home',
          'icon'  => 'far fa-fw fa-user',
          'roles' => 'admin'
        ],

        [
            'text' => 'Event',
            'route'  => 'arsys.event.admin',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],

        [
            'text' => 'Written Research',
            'route'  => 'arsys.research.admin.monitoring',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],




        /*['header' => 'Assignment ArXiv',

        'roles' => 'admin'
        ],
        [
            'text' => 'Defence',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],

        [
            'text' => 'Lectures',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],


        ['header' => 'Research ArXiv',

        'roles' => 'admin'
        ],
        [
            'text' => 'Intelectual Property',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],

        [
            'text' => 'Article',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],

        [
            'text' => 'Research Report',
            'route'  => 'arxiv.assignment.faculty',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],
        */

        /*['header' => 'Utilities',

        'roles' => 'admin'
        ],





        [ 'text' =>'Sync Student',
          'route' => 'arsys.utilities.admin.sync-student',
          'icon'  => 'far fa-fw fa-paper-plane',
          'roles' => 'admin'
        ],

        [ 'text' =>'Sync Faculty',
          'route' => 'arsys.utilities.admin.sync-faculty',
          'icon'  => 'far fa-fw fa-paper-plane',
          'roles' => 'admin'
        ],

        [ 'text' =>'Sync Schedule',
          'route' => 'arsys.utilities.admin.sync-schedule',
          'icon'  => 'far fa-fw fa-paper-plane',
          'roles' => 'admin'
        ],

        [ 'text' =>'Sync Research',
          'route' => 'arsys.utilities.admin.sync-research',
          'icon'  => 'far fa-fw fa-paper-plane',
          'roles' => 'admin'
        ],



        [ 'text' =>'Research Truncate',
          'route' => 'arsys.utilities.admin.research-truncate',
          'icon'  => 'far fa-fw fa-paper-plane',
          'roles' => 'admin'
        ],
        */

        /*['header' => 'Lectures Timetable',

        'roles' => 'admin'
        ],


        [
            'text' => 'Dashboard',
            'route'  => 'timetable.admin',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],
        */





        ['header' => 'Head of Specialization Page',

        'roles' => 'specialization'
        ],

        [
            'text' => 'New Proposal',
            'route'  => 'arsys.review.specialization.proposal.new',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'specialization',
        ],

        [
            'text' => 'Revise Proposal',
            'route'  => 'arsys.review.specialization.revise-proposal',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'specialization',
        ],


        [
            'text' => 'Presentation Proposal',
            'route'  => 'arsys.review.specialization.presentation-proposal',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'specialization',
        ],

        /*[
            'text' => 'Rejected Proposal',
            'route'  => 'arsys.review.specialization.reject-proposal',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'specialization',
        ],
        */

        [
            'text' => 'In Progress',
            'route'  => 'arsys.research.specialization.in-progress',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'specialization',
        ],

        [
            'text' => 'Completed',
            'route'  => 'arsys.research.specialization.completed',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'specialization',
        ],

        [
            'text' => 'Login As',
            'route'  => 'arsys.user.specialization.login-as',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'specialization',
        ],

        ['header' => 'Head of Specialization (Arxiv)',
        'roles' => 'specialization'
        ],
        [
            'text' => 'Final defense',
            'route'  => 'arxiv.assignment.specialization.final-defense',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'specialization',
        ],

        [ 'text' =>'Refresh Login',
        'route' => 'arsys.user.refresh-login',
        'icon'  => 'far fa-fw fa-user',
        'roles' => 'faculty'
        ],


        

        /*[
            'text' => 'Application Letter',
            'route'  => 'arsys.document.clerk.application-letter',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'clerk',
        ],








        /*[
            'text' => 'search',
            'search' => true,
            'topnav' => true,
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'pages',
            'url'         => 'admin/pages',
            'icon'        => 'far fa-fw fa-file',
            'label'       => 4,
            'label_color' => 'success',
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ],
        [
            'text'    => 'multilevel',
            'icon'    => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text'    => 'level_one',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'level_two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
        ],
        ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ],
        */

        ['header' => 'Utilities',

        'roles' => 'admin'
        ],
        [
            'text' => 'Set Academic Year',
            'route'  => 'arsys.utilities.admin.set-academic-year',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],
        /*[
            'text' => 'Set Supervisor',
            'route'  => 'arsys.utilities.admin.set-supervisor',
            'icon' => 'fas fa-fw fa-user-circle',
            'roles' => 'admin',
        ],
        [ 'text' =>'Update Milestone',
        'route' => 'arsys.utilities.admin.update-milestone',
        'icon'  => 'far fa-fw fa-paper-plane',
        'roles' => 'admin'
        ],

        [ 'text' =>'Set Defense Presence',
        'route' => 'arsys.utilities.admin.set-defense-presence',
        'icon'  => 'far fa-fw fa-paper-plane',
        'roles' => 'admin'
        ],

        /*[ 'text' =>'Set event type',
        'route' => 'arsys.utilities.admin.set-event-type',
        'icon'  => 'far fa-fw fa-paper-plane',
        'roles' => 'admin'
        ],
        */



        /*[ 'text' =>'Sync research Spv',
          'route' => 'arsys.utilities.admin.sync-research-spv',
          'icon'  => 'far fa-fw fa-paper-plane',
          'roles' => 'admin'
        ],

        /*[ 'text' =>'Delete Event',
          'route' => 'arsys.utilities.admin.delete-event',
          'icon'  => 'far fa-fw fa-paper-plane',
          'roles' => 'admin'
        ],
        */

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        //JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
        App\Http\Controllers\AdminLTEFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [

        'DateRangePicker' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.css',
                ],
            ],
        ],

        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    */

    'livewire' => true,
];
