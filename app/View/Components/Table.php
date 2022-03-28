<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.table.index');
    }
}
