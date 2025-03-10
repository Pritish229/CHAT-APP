<?php

namespace App\View\Components;

use Illuminate\View\Component;

class imageuploade extends Component
{
    public $inputId;
    public $labelId;
    public $previewId;
    public $name;
    public $labelname;
    public $initialFileName;
    public $initialImageUrl;
    public $height;
    public $width;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputId, $name, $labelId, $previewId, $labelname, $initialFileName = 'Choose file', $initialImageUrl = null, $height = null, $width = null)
    {
        $this->inputId = $inputId;
        $this->labelId = $labelId;
        $this->previewId = $previewId;
        $this->name = $name;
        $this->labelname = $labelname;
        $this->initialFileName = $initialFileName;
        $this->initialImageUrl = $initialImageUrl;
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.imageuploade');
    }
}
