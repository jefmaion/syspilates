<?php

namespace App\Livewire\Admin;

use App\Actions\CreateDatabase;
use App\Models\Admin\Tenant;
use Closure;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;

class TenantsPage extends Component
{

    use WithPagination;

    public $tenant;

    public $active;

    public function create()
    {
        $this->dispatch('create-tenant')->to(CreateTenant::class);
    }

    public function edit($id)
    {
        $this->dispatch('edit-tenant', tenant: $id)->to(CreateTenant::class);
    }

    public function createDatabase(Tenant $tenant)
    {
        CreateDatabase::run($tenant);
    }

    public function deleteTenant(Tenant $tenant)
    {
        $this->tenant = $tenant;
        $this->dispatch('show-modal', modal: 'modal-delete');
    }

    public function setStatus(Tenant $tenant)
    {
        $tenant->update(['active' => !$tenant->active]);

        $this->dispatch('$refresh');
    }

    public function delete()
    {
        DB::statement("DROP  DATABASE " . $this->tenant->database);
        $this->tenant->delete();
    }

    public function render(): View|Closure|string
    {
        return view('livewire.admin.tenants-page', [
            'tenants' => Tenant::paginate(10)
        ]);
    }
}
