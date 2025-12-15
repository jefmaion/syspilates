<?php

declare(strict_types = 1);

namespace App\View\Components\Form;

use App\Models\Modality;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class SelectModality extends Component
{
    /**
 * @var Collection<int, Modality>
 */
    public Collection $modalities;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->modalities = Modality::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select-modality');
    }
}
