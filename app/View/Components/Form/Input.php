<?php

namespace App\View\Components\Form;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $type;
    public bool $label;
    public bool $error;
    public mixed $value;
    public string $labelText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        string $type = 'text',
        $label = true,
        $error = true
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->labelText = __(str_replace('_', ' ', Str::title($name)));
        $this->error = $error;
        $this->value = old($name);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.form.input');
    }
}
