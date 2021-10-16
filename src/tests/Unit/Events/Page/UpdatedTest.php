<?php

namespace Tests\Unit\Events\Page;

use Carlson\NovaSimpleContent\Events\Page\Updated;
use Carlson\NovaSimpleContent\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UpdatedTest extends TestCase
{
    use RefreshDatabase;

    public function testPageDeletedEventSetsPageInConstructor()
    {
        $page = new Page;

        Event::fake();

        $updated_event = new Updated($page);

        $this->assertInstanceOf(Page::class, $updated_event->page);
    }
}
