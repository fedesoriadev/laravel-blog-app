<?php

namespace App\View\Components\Form;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Textarea extends Component
{
    public string $name;
    public ?string $label;
    public ?string $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        ?string $label = null,
        ?string $value = null
    ) {
        $this->name = $name;
        $this->label = $label ?? __(str_replace('_', ' ', Str::title($name)));
        $this->value = old($name, $value);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|string|\Closure
    {
        return view('components.form.textarea');
    }
}
