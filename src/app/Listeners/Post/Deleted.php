<?php

namespace Carlson\NovaSimpleContent\Listeners\Post;

use Carlson\NovaSimpleContent\Models\Post;
use Carlson\NovaSimpleContent\Events\Post\Deleted as Event;

class Deleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Carlson\NovaSimpleContent\Events\Post\Deleted  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $post = $event->post;

        if (config('nova-simple-content.cache_posts', true) == true) {
            Post::cacheAll();
            Post::forgetBySlug($post->post_type, $post->slug);
        }
    }
}