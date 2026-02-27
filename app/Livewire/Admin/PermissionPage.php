<?php

namespace App\Livewire\Admin;

use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionPage extends Component
{

    public $sync = [];

    public function mount()
    {
        foreach (Permission::orderBy('group')->get() as $permission) {
            foreach (Role::with('permissions')->get() as $role) {
                if ($role->hasPermissionTo($permission->name)) {
                    $this->sync[$role->id][$permission->id] = true;
                }
            }
        }
    }

    public function save()
    {
        foreach ($this->sync as $k => $permissions) {
            Role::findById($k)->syncPermissions(array_filter(array_keys($permissions)));
        }

        $this->dispatch('$refresh');
    }

    public function render(): View|Closure|string
    {
        return view('livewire.admin.permission-page', [
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }
}
