<?php

namespace Carlson\NovaSimpleContent\Events\Post;

use Carlson\NovaSimpleContent\Models\Post;
use Illuminate\Queue\SerializesModels;

class Updated
{
    use SerializesModels;

    public $post;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
