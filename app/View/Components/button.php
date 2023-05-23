<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class button extends Component
{


    public $isAnchor;
    public $format;


    public function __construct($isAnchor = false, $format = "primary")
    {
        $this->isAnchor = $isAnchor;
        $this->format = $format;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.button');
    }
}
