<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            'Super' => null,
            'Administrador' => null,
            'Aluno' => null,
            'Professor' => [
                ['name' => 'show calendar', 'group' => 'Calendario', 'label' => 'Mostrar Calendario'],
                ['name' => 'show calendar list', 'group' => 'Calendario', 'label' => 'Mostrar Calendario Lista'],

                ['name' => 'create student', 'group' => 'Aluno', 'label' => 'Cadastrar Aluno'],
                ['name' => 'edit student', 'group' => 'Aluno', 'label' => 'Editar Aluno'],

                ['name' => 'list student', 'group' => 'Aluno', 'label' => 'Listar Alunos'],

                ['name' => 'create registration', 'group' => 'Matrícula', 'label' => 'Cadastrar Matrícula'],
                ['name' => 'edit registration', 'group' => 'Matrícula', 'label' => 'Editar Matrícula'],
                ['name' => 'delete registration', 'group' => 'Matrícula', 'label' => 'Excluir Matrícula'],
                ['name' => 'list registration', 'group' => 'Matrícula', 'label' => 'Listar Matrículas'],
            ]

        ];

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();



        // create permissions
        Permission::create(['name' => 'delete student', 'group' => 'Aluno', 'label' => 'Excluir Aluno']);

        Permission::create(['name' => 'create modality', 'group' => 'Modalidade', 'label' => 'Cadastrar Modalidade']);
        Permission::create(['name' => 'edit modality', 'group' => 'Modalidade', 'label' => 'Editar Modalidade']);
        Permission::create(['name' => 'delete modality', 'group' => 'Modalidade', 'label' => 'Excluir Modalidade']);
        Permission::create(['name' => 'list modality', 'group' => 'Modalidade', 'label' => 'Listar Modalidades']);

        Permission::create(['name' => 'create instructor', 'group' => 'Professor', 'label' => 'Cadastrar Professor']);
        Permission::create(['name' => 'edit instructor', 'group' => 'Professor', 'label' => 'Editar Professor']);
        Permission::create(['name' => 'delete instructor', 'group' => 'Professor', 'label' => 'Excluir Professor']);
        Permission::create(['name' => 'list instructor', 'group' => 'Professor', 'label' => 'Listar Professores']);

        Permission::create(['name' => 'create transaction', 'group' => 'Financeiro', 'label' => 'Cadastrar Lançamento']);
        Permission::create(['name' => 'edit transaction', 'group' => 'Financeiro', 'label' => 'Editar Lançamento']);
        Permission::create(['name' => 'delete transaction', 'group' => 'Financeiro', 'label' => 'Excluir Lançamento']);
        Permission::create(['name' => 'list transaction', 'group' => 'Financeiro', 'label' => 'Listar Lançamentos']);

        Permission::create(['name' => 'view cashbook', 'group' => 'Financeiro', 'label' => 'Ver Livro Caixa']);
        Permission::create(['name' => 'calculate comission', 'group' => 'Financeiro', 'label' => 'Calcular Comissões']);


        // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        // create roles and assign created permissions
        foreach ($roles as $role => $permissions) {
            $role = Role::create(['name' => $role]);

            if (is_array($permissions)) {
                foreach ($permissions as $permission) {
                    $perm = Permission::create($permission);
                    $role->givePermissionTo($perm);
                }
            }
        }


        Role::findByName('Administrador')->givePermissionTo(Permission::all());
        // Role::findByName('Professor')->givePermissionTo(Permission::all());

        // this can be done as separate statements
        // $role = Role::create(['name' => 'writer']);
        // $role->givePermissionTo('edit articles');

        // // or may be done by chaining
        // $role = Role::create(['name' => 'moderator'])
        //     ->givePermissionTo(['publish articles', 'unpublish articles']);

        // $role = Role::create(['name' => 'super-admin']);
        // $role->givePermissionTo(Permission::all());
    }
}
