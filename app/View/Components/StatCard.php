<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{

    public $count = -1;
    public $url = '';
    public $title = '';
    public $img = 'card-1.png';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count = "", $url = '', $title = '', $img = '')
    {
        $this->count = $count;
        $this->url = $url;
        $this->title = $title;
        $this->img = $img;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.stat-card');
    }
}
