<?php

declare(strict_types = 1);

return [

    /** Configure the theme for Tabler.io */
    'theme-config' => [
        'theme'         => 'light',  /** light, dark */
        'theme-base'    => 'stone',  /** slate, gray, zinc, neutral, stone */
        'theme-font'    => 'sans-serif',  /** sans-serif, serif, monospace, comic */
        'theme-primary' => 'blue',  /** blue, azure, indigo, purple, pink, red, orange, yellow, lime, green, teal, cyan    */
        'theme-radius'  => '1',  /** 0, 0.5, 1, 1.5, 2 */
    ],

    /** Sidebar menu items */
    'sidebar-menu' => [

        // 'Admin' => 'nav-header',

        // 'Clientes' => [
        //     'route' => 'admin.tenants',
        //     'icon'  => file_get_contents(resource_path('views/components/icons/calendar.blade.php')),
        // ],

        'Aulas ' => 'nav-header',

        'Calendário' => [
            'route' => 'calendar',
            'icon'  => file_get_contents(resource_path('views/components/icons/calendar.blade.php')),
        ],

        'Cadastros' => 'nav-header',

        'Alunos' => [
            'route' => 'student',
            'icon'  => file_get_contents(resource_path('views/components/icons/users.blade.php')),
        ],

        'Professores' => [
            'route' => 'instructor',
            'icon'  => file_get_contents(resource_path('views/components/icons/instructor.blade.php')),
        ],

        'Matrículas' => [
            'route' => 'registration',
            'icon'  => file_get_contents(resource_path('views/components/icons/registration.blade.php')),
        ],

        'Modalidades' => [
            'route' => 'modality',
            'icon'  => file_get_contents(resource_path('views/components/icons/list.blade.php')),
        ],

        'Financeiro' => 'nav-header',

        'Lançamentos' => [
            'route' => 'transaction',
            'icon'  => file_get_contents(resource_path('views/components/icons/users.blade.php')),
        ],

        'Livro Caixa' => [
            'route' => 'cashbook',
            'icon'  => file_get_contents(resource_path('views/components/icons/users.blade.php')),
        ],

    ],

];
