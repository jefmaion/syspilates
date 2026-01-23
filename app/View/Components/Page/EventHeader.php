<?php

declare(strict_types = 1);

namespace App\View\Components\Page;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventHeader extends Component
{
    public $student;

    public $instructor;

    public $time;

    public $modality;

    /**
     * Create a new component instance.
     */
    public function __construct($student = null, $instructor = null, $time = null, $modality = null)
    {
        $this->student    = $student;
        $this->instructor = $instructor;
        $this->time       = $time;
        $this->modality   = $modality;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.page.event-header');
    }
}
