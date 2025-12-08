<?php

declare(strict_types = 1);

return [

    'theme-config' => [
        'theme'         => 'light', /** light, dark */
        'theme-base'    => 'stone', /** slate, gray, zinc, neutral, stone */
        'theme-font'    => 'sans-serif', /** sans-serif, serif, monospace, comic */
        'theme-primary' => 'azure', /** blue, azure, indigo, purple, pink, red, orange, yellow, lime, green, teal,m cyan    */
        'theme-radius'  => '0.5', /** 0, 0.5, 1, 1.5, 2 */
    ],

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
