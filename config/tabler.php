<?php

declare(strict_types = 1);

return [

    'theme-config' => [
        'theme'         => 'light',      /** light, dark */
        'theme-base'    => 'stone',      /** slate, gray, zinc, neutral, stone */
        'theme-font'    => 'sans-serif', /** sans-serif, serif, monospace, comic */
        'theme-primary' => 'purple',     /** blue, azure, indigo, purple, pink, red, orange, yellow, lime, green, teal,m cyan    */
        'theme-radius'  => '0.5',        /** 0, 0.5, 1, 1.5, 2 */
    ],

    'sidebar-menu' => [

        'Painel de Controle' => [
            'route' => 'dashboard',
            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>',
        ],

        'Menu Item 1' => [
            'route' => 'profile',
            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>',
        ],

        'Menu Item 2' => [
            'route' => '',
            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>',

            'submenu' => [

                'Sub Item 1' => [
                    'route' => '',
                    'icon'  => '',

                    'submenu' => [
                        'Sub Sub Item 2' => [
                            'route' => '',
                            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>',
                            'tag' => ['color' => 'bg-green', 'label' => 'Opa'],
                        ],
                    ],
                ],

                'Sub Item 2' => [
                    'route' => '',
                    'icon'  => '',
                ],
                'Sub Item 3' => [
                    'route' => false,
                    'icon'  => '',
                ],
            ],
        ],

        'Menu Item 3' => [
            'route' => false,
            'icon'  => '',
        ],

    ],

];
