<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class accordion extends Component
{

    public $children;
    public $titleTag;

    public function __construct($children, $titleTag = "span")
    {
        $this->children = $children;
        $this->titleTag = $titleTag;
    }

    public function render(): View|Closure|string
    {
        return view('components.molecules.accordion');
    }
}
