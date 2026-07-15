<?php

namespace App\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Closure;
use Livewire\Component;
use Illuminate\View\View;

class UserPage extends Component
{
    public function render() : View|Closure|string
    {

        $users = User::has('roles')->with('roles')->where('id', '<>', auth()->user()->id)->get();

        return view('livewire.user.user-page', [
            'users' => $users
        ]);
    }
}
