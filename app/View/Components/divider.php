<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class divider extends Component
{
    
    public $spaceValue;

    public function __construct($spaceValue = "2")
    {
        $this->spaceValue = $spaceValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.divider');
    }
}
