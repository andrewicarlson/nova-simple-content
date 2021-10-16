<?php

namespace Tests\Unit\Controllers\Post;

use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carlson\NovaSimpleContent\Models\Post;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
    }

    public function testControllerListReturnsView()
    {
        $response = $this->get('/blog');

        $response->assertViewHas('posts');
        $response->assertViewIs('nova-simple-content::posts.list');
    }

    public function testControllerDetailReturns404IfNotFound()
    {
        $response = $this->get('/blog/test');

        $response->assertNotFound();
    }

    public function testControllerDetailReturnsViewIfFound()
    {
        $post = new Post;
        $post->title = "Test";
        $post->body = "Test body";
        $post->slug = "test";
        $post->seo_title = "Test SEO title";
        $post->seo_description = "Test SEO description";
        $post->save();

        $response = $this->get('/blog/test');

        $response->assertViewHas('post');
        $response->assertViewIs('nova-simple-content::posts.detail');
    }
}
