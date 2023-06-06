<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dropDown extends Component
{

    public $id;
    public $options;

    public function __construct($id, $options)
    {
        $this->id = $id;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.molecules.drop-down');
    }
}
