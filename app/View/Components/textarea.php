<?php

namespace App\View\Components;

use Illuminate\View\Component;

class textarea extends Component
{
    public $label;
    public $placeholder;
    public $name ;
    public $value ;
    public $id ;
    public $helpertxt ;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label , $placeholder , $id ,$name , $value = null , $helpertxt = null)
    {
        //
        $this->label = $label;
        $this->placeholder = $placeholder ;
        $this->name = $name;
        $this->value = $value;
        $this->id = $id;
        $this->helpertxt = $helpertxt;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.textarea');
    }
}
