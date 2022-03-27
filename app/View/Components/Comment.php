<?php

namespace App\View\Components;

use App\Models\Comment as CommentModel;
use Illuminate\View\Component;

class Comment extends Component
{

    public function __construct(
        public CommentModel $comment
    ) {}

    public function render(): \Illuminate\Contracts\View\View|string|\Closure
    {
        return view('components.comment');
    }
}
