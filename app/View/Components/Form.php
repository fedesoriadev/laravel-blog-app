<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $action,
        public string $method
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.form.index');
    }
}
