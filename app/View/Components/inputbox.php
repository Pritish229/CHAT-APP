<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputbox extends Component
{
    public $label;
    public $type;
    public $placeholder;
    public $name;
    public $value;
    public $id;
    public $disabled;
    public $required;
    public $helpertxt;
    /**
     * Create a new component instance.
     *
     * @return void
     * 
     */
    public function __construct($label, $type, $placeholder, $name, $id, $value = null, $disabled = false, $helpertxt = null, $required = false)
    {
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->value = $value;
        $this->id = $id;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->helpertxt = $helpertxt;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputbox');
    }
}
