<?php

namespace App\View\Components\Form;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Select extends Component
{
    public string $name;
    public Collection $options;
    public ?string $label;
    public ?string $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name,
        Collection $options,
        ?string $label = null,
        ?string $value = null
    ) {
        $this->name = $name;
        $this->options = $options;
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
        return view('components.form.select');
    }

    /**
     * @param $option
     * @return bool
     */
    public function isSelected($option): bool
    {
        return $option == $this->value;
    }
}
