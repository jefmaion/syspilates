<?php

namespace App\Livewire\Role;

use App\Models\Permission;
use App\Models\Role;
use Closure;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class RoleForm extends Component
{

    public bool $edit = false;

    public $roleName;

    public $systemRoles = [];

    public ?Role $role = null;

    public function mount() {
        $this->systemRoles = config('roles.system_roles');
    }

     public function rules(): array
    {
        return [
            'roleName'    => ['required', 'max:100', Rule::unique('tenant.roles', 'name')->ignore($this->role?->id)],
        ];
    }

    #[On('create-role')]
      public function create() {
        $this->roleName = '';
        $this->role = null;
        $this->dispatch('show-modal', modal: 'modal-form-role');
    }

     #[On('edit-role')]
    public function edit(Role  $role): void
    {
       $this->role = $role;
       $this->edit = true;

       $this->roleName = $role->name;
       $this->dispatch('show-modal', modal: 'modal-form-role');
    }

    public function save() {
        $this->validate();

       if($this->edit) {
            $this->edit = false;
            $this->role->update(['name' => $this->roleName]);
            $this->dispatch('hide-modal', modal: 'modal-form-role');
            $this->dispatch('show-alert', message: 'Grupo alterado com sucesso!');
            $this->dispatch('role-updated');
            return;
       }



        Role::create(['name' => $this->roleName]);
        $this->dispatch('hide-modal', modal: 'modal-form-role');
        $this->dispatch('show-alert', message: 'Grupo cadastrado com sucesso!');
        $this->dispatch('role-updated');

         $this->role = null;
    }

    public function removeRole() {

        if(in_array($this->role->name, $this->systemRoles)) {
            $this->role = null;
            $this->dispatch('hide-modal', modal: 'modal-form-role');
            $this->dispatch('show-alert', message: 'Não é possível excluir grupos do sistema');
            return;
        }

        $this->role->delete();
        $this->dispatch('hide-modal', modal: 'modal-form-role');
        $this->dispatch('show-alert', message: 'Grupo cadastrado com sucesso!');
        $this->dispatch('role-updated');
    }

    public function render() : View|Closure|string
    {

        $permissions = Permission::all();

        $group = [];
        foreach($permissions as $permission) {
            $group[$permission->group][] = $permission;
        }



        return view('livewire.role.role-form', [
            'permissions' => $group
        ]);
    }
}
