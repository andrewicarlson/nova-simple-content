<?php

namespace Tests\Unit\Events\Post;

use Carlson\NovaSimpleContent\Events\Post\Deleted;
use Carlson\NovaSimpleContent\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class DeletedTest extends TestCase
{
    use RefreshDatabase;
    
    public function testPageDeletedEventSetsPageInConstructor()
    {
        $post = new Post;

        Event::fake();

        $deleted_event = new Deleted($post);

        $this->assertInstanceOf(Post::class, $deleted_event->post);
    }
}
