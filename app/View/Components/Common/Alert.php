<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{

    public $type = "info";
    public $icon = null;

    /**
     * Create a new component instance.
     */
    public function __construct($type = 'info', $icon = null)
    {
        $this->type = $type;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.common.alert');
    }
}
