<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Tenant;
use Closure;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;

class TenantsPage extends Component
{

    use WithPagination;

    public function create()
    {
        $this->dispatch('create-tenant')->to(CreateTenant::class);
    }

    public function edit($id)
    {
        $this->dispatch('edit-tenant', tenant: $id)->to(CreateTenant::class);
    }

    public function render(): View|Closure|string
    {
        return view('livewire.admin.tenants-page', [
            'tenants' => Tenant::paginate(10)
        ]);
    }
}
