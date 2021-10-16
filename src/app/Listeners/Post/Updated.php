<?php

namespace Carlson\NovaSimpleContent\Listeners\Post;

use Carlson\NovaSimpleContent\Models\Post;
use Carlson\NovaSimpleContent\Events\Post\Updated as Event;

class Updated
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
     * @param  Carlson\NovaSimpleContent\Events\Post\Updated  $event
     * @return void
     */
    public function handle(Event $event)
    {
        if (config('nova-simple-content.cache_posts', true) == true) {
            Post::cacheBySlug($event->post);
            Post::cacheAll();
        }
    }
}
