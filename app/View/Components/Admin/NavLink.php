<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $path = null
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.admin.nav-link');
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return request()->is($this->path);
    }
}
