<?php

namespace Tests\Unit\Listeners\Post;

use Carlson\NovaSimpleContent\Events\Post\Updated as UpdatedEvent;
use Carlson\NovaSimpleContent\Listeners\Post\Updated;
use Carlson\NovaSimpleContent\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UpdatedTest extends TestCase
{
    use RefreshDatabase;

    public function testPostUpdatedListenerCachesIndividualAndAllPosts()
    {
        $post_updated_listener = new Updated();

        $post = new Post;

        Cache::shouldReceive('put')
            ->once()
            ->with('post_slug_', Post::class, Carbon::class)
            ->andReturn(Collection::class);

        Cache::shouldReceive('put')
            ->once()
            ->with('posts', Collection::class, Carbon::class)
            ->andReturn(Collection::class);

        $post_updated_listener->handle(new UpdatedEvent($post));
    }
}
