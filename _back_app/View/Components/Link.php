<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Link extends Component
{
    public $type = 'link';
    public $modalId = '#';
    public $classes = '';
    public $url = '#';
    public $icon = '';
    public $title = '';
    public $ionIcon = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'link', $modalId = '', $classes, $url = '', $icon = '', $title = '', $ionIcon = '')
    {
        $this->type = $type;
        $this->modalId = $modalId;
        $this->classes = $classes;
        $this->icon = $icon;
        $this->url = $url;
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
        return view('components.link');
    }
}
