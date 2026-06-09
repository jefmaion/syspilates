<?php

declare(strict_types=1);

return [

    'menu' =>  [

        'Aulas' => [
            'permission' => 'calendar.access',
            'items' => [

                'Calendário' => [
                    'route' => 'calendar',
                    'icon' => 'icons.calendar',
                    'permission' => 'calendar.view',
                ],

                'Aulas do Dia' => [
                    'route' => 'today',
                    'icon' => 'icons.calendar',
                    'permission' => 'calendar.today',
                ],

            ],
        ],

        'Cadastros' => [
            'permission' => 'students.access',
            'items' => [

                'Alunos' => [
                    'route' => 'student',
                    'icon' => 'icons.users',
                    'permission' => 'students.view',
                ],

                'Professores' => [
                    'route' => 'instructor',
                    'icon' => 'icons.instructor',
                    'permission' => 'instructors.view',
                ],

                'Matrículas' => [
                    'route' => 'registration',
                    'icon' => 'icons.registration',
                    'permission' => 'registrations.view',
                ],

                'Modalidades' => [
                    'route' => 'modality',
                    'icon' => 'icons.modality',
                    'permission' => 'modalities.view',
                ],

                'Planos' => [
                    'route' => 'plan',
                    'icon' => 'icons.list',
                    'permission' => 'plans.view',
                ],

            ],
        ],

        'Financeiro' => [
            'permission' => 'transactions.access',
            'items' => [

                'Lançamentos' => [
                    'route' => 'transaction',
                    'icon' => 'icons.money',
                    'permission' => 'transactions.view',
                ],

                'Livro Caixa' => [
                    'route' => 'cashbook',
                    'icon' => 'icons.money',
                    'permission' => 'cashbook.view',
                ],

                'Comissões' => [
                    'route' => 'comission',
                    'icon' => 'icons.users',
                    'permission' => 'commissions.calculate',
                ],

            ],
        ],

        'Configurações' => [
            'permission' => 'settings.access',
            'items' => [

                'Usuários' => [
                    'route' => 'users',
                    'icon' => 'icons.users',
                    'permission' => 'manage.users',
                ],

                'Grupos e Permissões' => [
                    'route' => 'roles',
                    'icon' => 'icons.users',
                    'permission' => 'manage.roles',
                ],

            ],
        ],
    ]

];
