<?php

namespace Tests\Unit\Events\Post;

use Carlson\NovaSimpleContent\Events\Post\Updated;
use Carlson\NovaSimpleContent\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UpdatedTest extends TestCase
{
    use RefreshDatabase;

    public function testPageDeletedEventSetsPageInConstructor()
    {
        $post = new Post;

        Event::fake();

        $updated_event = new Updated($post);

        $this->assertInstanceOf(Post::class, $updated_event->post);
    }
}
