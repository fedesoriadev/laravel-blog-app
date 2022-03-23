<?php

namespace App\View\Components;

use App\Models\Post as PostModel;
use Illuminate\View\Component;

class Post extends Component
{
    public PostModel $post;
    public string $postUrl;
    public string $authorUrl;
    public string $authorName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(PostModel $post)
    {
        $this->post = $post;
        $this->postUrl = route('posts.show', $post->slug);
        $this->authorName = $post->author->name;
        $this->authorUrl = route('authors.show', $post->author->username);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|string|\Closure
    {
        return view('components.post');
    }
}
