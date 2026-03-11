<?php

namespace App\View\Components\Form;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class SelectUser extends Component
{

    public Collection $users;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->users = User::orderBy('name', 'asc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select-user');
    }
}
