<?php

namespace App\View\Components\Sidebar;

use Illuminate\View\Component;

class MenuItem extends Component
{
    public $menu;

    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    public function render()
    {
        return view('components.sidebar.menu-item');
    }
}