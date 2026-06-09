<?php

namespace App\Livewire\Role;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\PaginationTrait;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class RolePage extends Component
{

    use PaginationTrait;

    public $checked = false;
    public $sync = [];

    public $roleName;

    public function _sync(Role $role, $permission, $remove=false) {
        if($remove) {
            return $role->revokePermissionTo($permission);
        }

        $role->givePermissionTo($permission);

        $this->dispatch('$refresh');
    }

    #[On('role-updated')]
    public function refresh(): void
    {
        $this->dispatch('$refresh');
    }





    public function render() : View|Closure|string
    {


       $permissions = Permission::all();

        $group = [];
        foreach($permissions as $permission) {
            $group[$permission->group][] = $permission;
        }


        return view('livewire.role.role-page', [
            'roles' =>  Role::with('permissions')->whereNotIn('name', array_diff(config('roles.system_roles'), ['Professor']))->get(),
            'permissions' => $group
        ]);
    }
}
