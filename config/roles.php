<?php

declare(strict_types=1);

return [

    'permissions' => [

        'Calendário' => [
            'calendar.access' => 'Acessar Calendário',
            'calendar.view' => 'Ver Calendário',
            'calendar.today' => 'Aulas do Dia',
            'change.class.instructor' => 'Alterar professor de uma aula',
            'register.class' => 'Registrar Presença/Falta'
        ],

        'Alunos' => [
            'students.access'   => 'Acessar Alunos',
            'students.view'   => 'Acessar Alunos',
            'students.list'   => 'Listar Alunos',
            'students.create' => 'Cadastrar Aluno',
            'students.edit'   => 'Editar Aluno',
            'students.delete' => 'Excluir Aluno',
        ],

        'Modalidades' => [
            'modalities.access'   => 'Acessar Modalidades',
            'modalities.view'   => 'Acessar Modalidades',
            'modalities.list'   => 'Listar Modalidades',
            'modalities.create' => 'Cadastrar Modalidade',
            'modalities.edit'   => 'Editar Modalidade',
            'modalities.delete' => 'Excluir Modalidade',
        ],

        'Planos' => [
            'plans.access'   => 'Acessar Planos',
            'plans.view'   => 'Acessar Planos',
            'plans.list'   => 'Listar Planos',
            'plans.create' => 'Cadastrar Planos',
            'plans.edit'   => 'Editar Planos',
            'plans.delete' => 'Excluir Plano',
        ],

        'Professores' => [
            'instructors.access'   => 'Acessar Professores',
            'instructors.view'   => 'Acessar Professores',
            'instructors.list'   => 'Listar Professores',
            'instructors.create' => 'Cadastrar Professor',
            'instructors.edit'   => 'Editar Professor',
            'instructors.delete' => 'Excluir Professor',
        ],

        'Matrículas' => [
            'registrations.access'   => 'Acessar Matrículas',
            'registrations.view'   => 'Acessar Matrículas',
            'registrations.list'   => 'Listar Matrículas',
            'registrations.create' => 'Cadastrar Matrícula',
            'registrations.edit'   => 'Editar Matrícula',
            'registrations.delete' => 'Excluir Matrícula',
        ],

        'Financeiro' => [
            'transactions.access'   => 'Acessar Lançamentos',
            'transactions.view'   => 'Acessar Lançamentos',
            'transactions.list'   => 'Listar Lançamentos',
            'transactions.create' => 'Cadastrar Lançamento',
            'transactions.edit'   => 'Editar Lançamento',
            'transactions.delete' => 'Excluir Lançamento',
            'cashbook.view'        => 'Ver Livro Caixa',
            'commissions.calculate' => 'Calcular Comissões',
        ],

        'Configurações' => [
            'settings.access' => 'Acessar Configurações',
            'manage.users' => 'Acessar Usuários',
            'manage.roles' => 'Accessar Permissões',
        ]

    ],


    'roles' => [

        'Super' => '*',

        'Administrador' => '*',

        'Professor' => [

            'calendar.access',
            'calendar.view',
            'calendar.today',
            'register.class',

            'students.access',
            'students.view',
            'students.list',
            'students.create',
            'students.edit',

            'registrations.access',
            'registrations.view',
            'registrations.list',
            'registrations.create',
            'registrations.edit',
        ],

        // 'Aluno' => [],
    ],

    'system_roles' => ['Super', 'Administrador', 'Professor']

];
