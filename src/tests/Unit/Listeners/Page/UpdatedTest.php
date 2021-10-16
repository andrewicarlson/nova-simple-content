<?php

namespace Tests\Unit\Listeners\Page;

use Carlson\NovaSimpleContent\Events\Page\Updated as UpdatedEvent;
use Carlson\NovaSimpleContent\Listeners\Page\Updated;
use Carlson\NovaSimpleContent\Models\Page;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UpdatedTest extends TestCase
{
    use RefreshDatabase;

    public function testPageUpdatedListenerCachesIndividualAndAllPages()
    {
        $page_updated_listener = new Updated();

        $page = new Page;

        Cache::shouldReceive('put')
            ->once()
            ->with('page_slug_', Page::class, Carbon::class)
            ->andReturn(Collection::class);

        Cache::shouldReceive('put')
            ->once()
            ->with('pages', Collection::class, Carbon::class)
            ->andReturn(Collection::class);

        $page_updated_listener->handle(new UpdatedEvent($page));
    }
}
