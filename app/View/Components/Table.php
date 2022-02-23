<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{

    public $dataTable;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dataTable = null)
    {
        $this->dataTable = $dataTable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table');
    }
}
