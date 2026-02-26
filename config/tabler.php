<?php

declare(strict_types=1);

return [

    /** Configure the theme for Tabler.io */
    'theme-config' => [
        /** light, dark */
        'theme-base'    => 'zinc',
        /** slate, gray, zinc, neutral, stone */
        'theme-font'    => 'sans-serif',
        /** sans-serif, serif, monospace, comic */
        'theme-primary' => 'blue',
        /** blue, azure, indigo, purple, pink, red, orange, yellow, lime, green, teal, cyan    */
        'theme-radius'  => '1',
        /** 0, 0.5, 1, 1.5, 2 */
    ],

    /** Sidebar menu items */
    'sidebar-menu' => [


        'Aulas ' => 'nav-header',

        'Calendário' => [
            'route' => 'calendar',
            'icon'  => 'icons.calendar',
        ],

        'Aulas do Dia' => [
            'route' => 'today',
            'icon'  => 'icons.calendar',
        ],

        'Cadastros' => 'nav-header',

        'Alunos' => [
            'route' => 'student',
            'icon'  => 'icons.users',
        ],

        'Professores' => [
            'route' => 'instructor',
            'icon'  => 'icons.instructor',
        ],

        'Matrículas' => [
            'route' => 'registration',
            'icon'  => 'icons.registration',
        ],

        'Modalidades' => [
            'route' => 'modality',
            'icon'  => 'icons.list',
        ],

        'Financeiro' => 'nav-header',

        'Lançamentos' => [
            'route' => 'transaction',
            'icon'  => 'icons.money',
        ],

        'Livro Caixa' => [
            'route' => 'cashbook',
            'icon'  => 'icons.users',
        ],

        'Comissões' => [
            'route' => 'comission',
            'icon'  => 'icons.users',
        ],

    ],

];
