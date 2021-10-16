<?php

namespace Tests\Unit\Events\Page;

use Carlson\NovaSimpleContent\Events\Page\Deleted;
use Carlson\NovaSimpleContent\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class DeletedTest extends TestCase
{
    use RefreshDatabase;

    public function testPageDeletedEventSetsPageInConstructor()
    {
        $page = new Page;

        Event::fake();

        $deleted_event = new Deleted($page);

        $this->assertInstanceOf(Page::class, $deleted_event->page);
    }
}
