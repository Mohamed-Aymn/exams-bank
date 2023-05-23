<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class mobileBottomNavButton extends Component
{
    public $content;
    public function __construct($content)
    {
        $this->content = explode(" ", $content);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.mobile-bottom-nav-button');
    }
}
