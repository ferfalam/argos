<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $id = '';
    public $classes = '';
    public $icon = '';
    public $ionIcon = '';
    public $title = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = '', $classes, $icon = '', $title = '', $ionIcon = '')
    {
        $this->id = $id;
        $this->classes = $classes;
        $this->icon = $icon;
        $this->title = $title;
        $this->ionIcon = $ionIcon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.button');
    }
}
