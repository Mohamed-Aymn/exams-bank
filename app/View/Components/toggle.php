<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class toggle extends Component
{
    
    public $id;
    public $firstOption;
    public $secondOption;
    public $default;

    public function __construct($id, $firstOption, $secondOption = null, $default = "firstOption")
    {
        $this->firstOption = $firstOption;
        $this->secondOption = $secondOption;
        $this->id = $id;
        $this->default = $default;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.toggle');
    }
}
