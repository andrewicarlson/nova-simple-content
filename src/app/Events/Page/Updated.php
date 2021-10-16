<?php

namespace Carlson\NovaSimpleContent\Events\Page;

use Carlson\NovaSimpleContent\Models\Page;
use Illuminate\Queue\SerializesModels;

class Updated
{
    use SerializesModels;

    public $page;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }
}
