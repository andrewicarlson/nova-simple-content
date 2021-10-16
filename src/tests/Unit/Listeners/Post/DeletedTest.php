<?php

namespace Tests\Unit\Listeners\Post;

use Carlson\NovaSimpleContent\Events\Post\Deleted as DeletedEvent;
use Carlson\NovaSimpleContent\Listeners\Post\Deleted;
use Carlson\NovaSimpleContent\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class DeletedTest extends TestCase
{
    use RefreshDatabase;

    public function testPostUpdatedListenerCachesIndividualAndAllPosts()
    {
        $post_deleted_listener = new Deleted();

        $post = new Post;

        Cache::shouldReceive('put')
            ->once()
            ->with('posts', Collection::class, Carbon::class)
            ->andReturn(Collection::class);

        Cache::shouldReceive('forget')
            ->once()
            ->with('post_slug_')
            ->andReturn(true);

        $post_deleted_listener->handle(new DeletedEvent($post));
    }
}
