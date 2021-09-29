<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FlashMsg extends Component
{

    public $type, $key;

    public function __construct($type, $key)
    {
        $this->type = $type;
        $this->key = $key;

    }

    public function render()
    {
        return view('components.flash-msg');
    }
}
