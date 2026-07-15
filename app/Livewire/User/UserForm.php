<?php

namespace App\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;

class UserForm extends Component
{
     public bool $edit = false;

     public ?User  $user = null;

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
            'email'     => ['required', 'email', Rule::unique('tenant.users', 'email')->ignore($this->user?->id)],
            'cpf'       => ['required', Rule::unique('tenant.users', 'cpf')->ignore($this->user?->id)],
            'phone1'    => ['required'],
            'userRoles' => ['array', 'required']
        ];
    }

    #[On('create-user')]
      public function create() {
        $this->name=null;
        $this->email=null;
        $this->cpf=null;
        $this->phone1=null;
        $this->userRoles = [];
        $this->user = null;
        $this->edit = false;
        $this->sendEmail = false;
        $this->dispatch('show-modal', modal: 'modal-form-user');
    }

     #[On('edit-user')]
    public function edit(User $user): void
    {

        $this->user = $user;

        $this->name=$user->name;
        $this->email=$user->email;
        $this->cpf=$user->cpf;
        $this->phone1=$user->phone1;
        $this->userRoles = $this->user->getRoleNames();

        $this->edit = true;

        $this->dispatch('show-modal', modal: 'modal-form-user');
    }

    public function save() {
        $this->validate();
        $sendEmail = null;
        if($this->edit) {
            $this->user->update([
                'name' => $this->name,
                'cpf' => $this->cpf,
                'email' => $this->email,
                'phone1' => $this->phone1,
            ]);
            $this->user->syncRoles($this->userRoles);
            $sendEmail = $this->user->email;
        } else {
            $user = User::create([
                'name' => $this->name,
                'cpf' => $this->cpf,
                'email' => $this->email,
                'phone1' => $this->phone1,
                'password' => Hash::make('password')
            ]);
            $user->syncRoles($this->userRoles);
            $sendEmail = $this->email;
        }

        if($this->sendEmail) {
            $this->sendPasswordReset($sendEmail);
        }

        return $this->dispatch('hide-modal', modal: 'modal-form-user');

    }

    private function sendPasswordReset($email) {
        $status = Password::broker()->sendResetLink([
            'email' => $email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->dispatch('show-alert', message: 'E-mail de redefinição enviado com sucesso.');
        } else {
            $this->dispatch('show-alert', message: $status);
        }
    }

    public function render() : View|Closure|string
    {
        return view('livewire.user.user-form', [
            'roles' => Role::whereNotIn('id', [1])->get()
        ]);
    }
}
