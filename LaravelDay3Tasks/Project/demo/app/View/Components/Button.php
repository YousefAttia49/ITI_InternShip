<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $class , $content;

    /**
     * Create a new component instance.
     */
    public function __construct($class,$content)
    {
        //
        $this->class=$class;
        $this->content=$content;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
