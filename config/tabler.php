<?php

declare(strict_types = 1);

return [

    'sidebar-menu' => [

        'Menu Item 1' => [
            'active' => true,
            'link'   => '/example',
            'icon'   => '',
        ],

        'Menu Item 2' => [
            'active' => false,
            'link'   => '#',
            'icon'   => '',

            'submenu' => [

                'Sub Item 1' => [
                    'active' => false,
                    'link'   => '#',
                    'icon'   => '',

                    'submenu' => [
                        'Sub Sub Item 2' => [
                            'active' => false,
                            'link'   => '#',
                            'icon'   => '',
                            'tag'    => ['color' => 'bg-green', 'label' => 'Opa'],
                        ],
                    ],
                ],

                'Sub Item 2' => [
                    'active' => false,
                    'link'   => '#',
                    'icon'   => '',
                ],
                'Sub Item 3' => [
                    'active' => false,
                    'link'   => '#',
                    'icon'   => '',
                ],
            ],
        ],

        'Menu Item 3' => [
            'active' => false,
            'link'   => '#',
            'icon'   => '',
        ],

    ],

];
