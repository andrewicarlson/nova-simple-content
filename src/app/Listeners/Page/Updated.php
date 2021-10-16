<?php

namespace Carlson\NovaSimpleContent\Listeners\Page;

use Carlson\NovaSimpleContent\Models\Page;
use Carlson\NovaSimpleContent\Events\Page\Updated as Event;

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
     * @param  Carlson\NovaSimpleContent\Events\Page\Updated  $event
     * @return void
     */
    public function handle(Event $event)
    {
        if (config('nova-simple-content.cache_pages', true) == true) {
            Page::cacheBySlug($event->page);
            Page::cacheAll();
        }
    }
}