<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectDropdown extends Component
{
    public $name;
    public $options;
    public $selected;

    public function __construct($name, $options, $selected = null)
    {
        $this->name = $name;
        $this->options = $options->pluck('name', 'id')->toArray(); // Assuming 'name' field in your data
        $this->selected = $selected;
    }

    public function render()
    {
        return view('components.select-dropdown');
    }
}
