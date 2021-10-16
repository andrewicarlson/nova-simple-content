<?php

namespace Carlson\NovaSimpleContent\Listeners\Page;

use Carlson\NovaSimpleContent\Models\Page;
use Carlson\NovaSimpleContent\Events\Page\Deleted as Event;

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
     * @param  Carlson\NovaSimpleContent\Events\Page\Deleted  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $page = $event->page;

        if (config('nova-simple-content.cache_posts', true) == true) {
            Page::cacheAll();
            Page::forgetBySlug($page->slug);
        }
    }
}
