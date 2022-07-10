<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    public $param;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $this->param = $param;
    }

    public function test($iii)
    {
        return $iii;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu');
    }
}
