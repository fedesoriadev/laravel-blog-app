<?php

namespace App\View\Components\Form;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $type;
    public ?string $label;
    public ?string $value;
    public bool $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        string $type = 'text',
        ?string $label = null,
        ?string $value = null,
        bool $required = false,
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label ?? __(str_replace('_', ' ', Str::title($name)));
        $this->value = old($name, $value);
        $this->required = $required;
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
