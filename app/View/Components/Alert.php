<?php

namespace App\View\Components;

use App\Enums\AlertType;
use Illuminate\View\Component;

class Alert extends Component
{
    public AlertType $alertType;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type)
    {
        $this->alertType = AlertType::from($type);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.alert');
    }
}
