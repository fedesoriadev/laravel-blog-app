<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class ProfilePicture extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public User $user,
        public string $size = 'sm'
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.auth.profile-picture');
    }

    /**
     * @return string
     */
    public function size(): string
    {
        return match ($this->size) {
            'xs' => 'w-6 h-6',
            'sm' => 'w-10 h-10',
            'md' => 'w-16 h-16',
            'lg' => 'w-24 h-24',
            'xl' => 'w-32 h-32',
        };
    }
}
