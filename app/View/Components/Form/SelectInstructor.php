<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use App\Models\Instructor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class SelectInstructor extends Component
{
    /**
     * @var Collection<int, Instructors>
     */
    public Collection $instructors;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->instructors = Instructor::with('user')->whereHas('user', function ($query) {
            return $query->where('active', 1);
        })->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-instructor');
    }
}
