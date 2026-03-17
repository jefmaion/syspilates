<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Tenant;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class CreateTenant extends Component
{

    public ?Tenant $tenant = null;

    public $name;
    public $subdomain;
    public $create_database;
    public $company_name;
    public $phone;
    public $email;

    public function rules()
    {
        return [
            'subdomain' => ['required', Rule::unique('landlord.tenants', 'subdomain')->ignore($this->tenant?->id)],
            'company_name' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'name' => ['required'],
        ];
    }

    #[On('create-tenant')]
    public function create()
    {
        $this->resetValidation();
        $this->reset();
        $this->dispatch('show-modal', modal: 'modal-form-tenant');
    }

    #[On('edit-tenant')]
    public function edit(Tenant $tenant)
    {
        $this->tenant = $tenant;
        $this->name = $this->tenant->name;
        $this->subdomain = $this->tenant->subdomain;
        $this->company_name = $this->tenant->company_name;
        $this->phone = $this->tenant->phone;
        $this->email = $this->tenant->email;

        $this->dispatch('show-modal', modal: 'modal-form-tenant');
    }

    public function save()
    {



        $this->validate();


        if (!empty($this->tenant)) {
            $this->tenant->update($this->all());
        } else {

            $data = $this->all();

            $data['database'] = "syspilates_" . $this->subdomain;

            Tenant::create($data);

            if ($this->create_database) {
                Config::set('database.connections.tenant.database', $data['database']);

                DB::statement("CREATE DATABASE " . $data['database']);
                DB::purge('tenant');

                Artisan::call('migrate:fresh', [
                    '--database' => 'tenant'
                ]);

                Artisan::call('db:seed', [
                    '--database' => 'tenant',
                    '--class' => 'RoleAndPermissionsSeeder'
                ]);

                User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone1' => $this->phone,
                    'password' => Hash::make('password')
                ])->assignRole('Administrador');
            }
        }



        $this->dispatch('hide-modal', modal: 'modal-form-tenant');
        $this->dispatch('$refresh');
    }


    public function render(): View|Closure|string
    {
        return view('livewire.admin.create-tenant');
    }
}
