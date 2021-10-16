<?php

namespace Tests\Unit\Listeners\Page;

use Carlson\NovaSimpleContent\Events\Page\Deleted as DeletedEvent;
use Carlson\NovaSimpleContent\Listeners\Page\Deleted;
use Carlson\NovaSimpleContent\Models\Page;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class DeletedTest extends TestCase
{
    use RefreshDatabase;

    public function testPageUpdatedListenerCachesIndividualAndAllPages()
    {
        $page_deleted_listener = new Deleted();

        $page = new Page;

        Cache::shouldReceive('put')
            ->once()
            ->with('pages', Collection::class, Carbon::class)
            ->andReturn(Collection::class);

        Cache::shouldReceive('forget')
            ->once()
            ->with('page_slug_')
            ->andReturn(true);

        $page_deleted_listener->handle(new DeletedEvent($page));
    }
}
