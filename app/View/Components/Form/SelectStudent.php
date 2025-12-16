<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use App\Models\Student;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class SelectStudent extends Component
{
    /**
 * @var Collection<int, Student>
 */
    public Collection $students;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->students = Student::with('user')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-student');
    }
}
