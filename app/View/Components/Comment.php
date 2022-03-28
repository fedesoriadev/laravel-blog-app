<?php

namespace App\View\Components;

use App\Models\Comment as CommentModel;
use Illuminate\View\Component;

class Comment extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public CommentModel $comment
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|string|\Closure
    {
        return view('components.comment');
    }
}