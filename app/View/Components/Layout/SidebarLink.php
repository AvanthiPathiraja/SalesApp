<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class SidebarLink extends Component
{
    public $path, $name;
    public function __construct( $path, $name)
    {
        $this->path = $path;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.sidebar-link');
    }
}
