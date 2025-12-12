<?php

declare(strict_types = 1);

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UserForm extends Form
{
    public string $name = '';

    public string $nickname = '';

    public string $avatar = '';

    public string $email = '';

    public string $birthdate = '';

    public string $gender = '';

    public string $cpf = '';

    public string $phone1 = '';

    public string $phone2 = '';

    public string $zipcode = '';

    public string $address = '';

    public string $district = '';

    public string $number = '';

    public string $complement = '';

    public string $city = '';

    public string $state = '';

    public ?User $user = null;

    public function getAddress(): void
    {
        $cepLimpo = preg_replace('/[^0-9]/', '', $this->zipcode);
        $data     = [];

        if (strlen($cepLimpo) === 8) {
            $response = Http::get("https://viacep.com.br/ws/{$cepLimpo}/json/");

            if ($response->ok() && ! $response->json('erro')) {
                $data = $response->json();
            }
        }

        if (! empty($data)) {
            $this->address  = $data['logradouro'];
            $this->district = $data['bairro'];
            $this->city     = $data['localidade'];
            $this->state    = $data['uf'];
            $this->zipcode  = $cepLimpo;
        }
    }

    public function rules(): array | string
    {
        return [
            'name'      => ['required'],
            'email'     => ['nullable', 'email', Rule::unique('users', 'email')->ignore($this->user?->id)],
            'birthdate' => ['required', 'date'],
            'gender'    => ['required'],
            'cpf'       => ['required', Rule::unique('users', 'cpf')->ignore($this->user?->id)],
            'phone1'    => ['required'],
            'state'     => ['max:2'],
            'number'    => ['max:5'],
        ];
    }

    public function create(): User
    {
        return User::create($this->all());
    }

    public function update(): bool
    {
        return $this->user->update($this->all());
    }

    public function populate(?User $user): void
    {
        $this->user = $user;

        $this->name       = $this->user->name ?? '';
        $this->nickname   = $this->user->nickname ?? '';
        $this->avatar     = $this->user->avatar ?? '';
        $this->birthdate  = isset($this->user) ? $this->user->birthdate->format('Y-m-d') : '';
        $this->gender     = $this->user->gender ?? '';
        $this->cpf        = $this->user->cpf ?? '';
        $this->phone1     = $this->user->phone1 ?? '';
        $this->phone2     = $this->user->phone2 ?? '';
        $this->zipcode    = $this->user->zipcode ?? '';
        $this->address    = $this->user->address ?? '';
        $this->district   = $this->user->district ?? '';
        $this->number     = $this->user->number ?? '';
        $this->city       = $this->user->city ?? '';
        $this->state      = $this->user->state ?? '';
        $this->complement = $this->user->complement ?? '';
        $this->email      = $this->user->email ?? '';
    }
}
