<?php

namespace App\Livewire\Admin;

use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionPage extends Component
{

    public $roless = [];

    public function mount() {}

    public function save()
    {
        dd($this->roless);
    }

    public function render(): View|Closure|string
    {

        $permissions = [];

        foreach (Permission::orderBy('group')->get() as $permission) {
            $permissions[$permission->group][] = $permission;
        }

        return view('livewire.admin.permission-page', [
            'roles' => Role::all(),
            'permissions' => $permissions
        ]);
    }
}
