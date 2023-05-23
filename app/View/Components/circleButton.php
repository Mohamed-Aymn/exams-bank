<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class floatingButton extends Component
{
    public $isFloating;
    public $floatPlace;
    public $animation;
    public $icon;
    public $id;

    
    public function __construct( $isFloating = false, $floatPlace = NULL, $animation = NULL, $icon = NULL, $id = NULL)
    {
        $this->isFloating = $isFloating;
        $this->floatPlace = $floatPlace;
        $this->animation = $animation;
        $this->icon = $icon;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atoms.circle-button');
    }
}
