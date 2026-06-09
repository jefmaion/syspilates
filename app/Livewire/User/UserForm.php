<?php

namespace App\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class UserForm extends Component
{
     public bool $edit = false;

     public $name='';
     public $email='';
     public $cpf='';
     public $phone1='';
     public $sendEmail = false;
     public $userRoles = [];

    public function rules(): array | string
    {
        return [
            'name'      => ['required'],
            'email'     => ['required', 'email', Rule::unique('tenant.users', 'email')],//->ignore($this->user?->id)
            'cpf'       => ['required', Rule::unique('tenant.users', 'cpf')], //->ignore($this->user?->id)
            'phone1'    => ['required'],
            'userRoles' => ['array', 'required']
        ];
    }

    #[On('create-user')]
      public function create() {
        $this->dispatch('show-modal', modal: 'modal-form-user');
    }

     #[On('edit-user')]
    public function edit(Role  $role): void
    {
       $this->role = $role;
       $this->edit = true;

       $this->roleName = $role->name;
       $this->dispatch('show-modal', modal: 'modal-form-user');
    }

    public function save() {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'phone1' => $this->phone1,
            'password' => Hash::make('password')
        ]);

        $user->syncRoles($this->userRoles);

        dd($user);
    }

    public function render() : View|Closure|string
    {
        return view('livewire.user.user-form', [
            'roles' => Role::whereNotIn('id', [1])->get()
        ]);
    }
}
