<?php

namespace Tests\Unit\Models\Post;

use Carlson\NovaSimpleContent\Models\Post;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class PostModelTest extends TestCase
{
    use RefreshDatabase;

    public function testCacheBySlugReceivesPost()
    {
        $post = new Post();
        $post->title = "Test";
        $post->body = "Test body";
        $post->slug = "test";
        $post->featured_image_url = "test.png";
        $post->seo_title = "Test SEO title";
        $post->seo_description = "Test SEO description";
        $post->post_type = "blog";
        $post->save();

        Cache::shouldReceive('put')
            ->once()
            ->with('post_slug_test', Post::class, Carbon::class)
            ->andReturn(Post::class);

        Post::cacheBySlug($post);
    }

    public function testGetBySlugReturnsPostIfInCache()
    {
        $post = new Post();
        $post->title = "Test";
        $post->body = "Test body";
        $post->slug = "test";
        $post->featured_image_url = "test.png";
        $post->seo_title = "Test SEO title";
        $post->seo_description = "Test SEO description";
        $post->post_type = "blog";
        $post->save();

        Post::cacheBySlug($post);

        Cache::shouldReceive('get')
            ->with('post_slug_test')
            ->andReturn($post);

        Post::getBySlug('test');
    }

    public function testGetBySlugReturnsPostFromDBIfExistsButCacheDisabled()
    {
        Config::set('nova-simple-content.cache_posts', false);

        $post = new Post();
        $post->title = "Test";
        $post->body = "Test body";
        $post->slug = "test";
        $post->seo_title = "Test SEO title";
        $post->seo_description = "Test SEO description";
        $post->save();

        Cache::shouldReceive('get')
            ->never();

        $retrieved_post = Post::getBySlug('test');

        $this->assertEquals($post->id, $retrieved_post->id);
    }

    public function testGetBySlugReturnsPostFromDBIfExistsButNotInCache()
    {
        $post = new Post();
        $post->title = "Test";
        $post->body = "Test body";
        $post->slug = "test";
        $post->featured_image_url = "test.png";
        $post->seo_title = "Test SEO title";
        $post->seo_description = "Test SEO description";
        $post->post_type = "blog";
        $post->save();

        Cache::shouldReceive('get')
            ->with('post_slug_test')
            ->andReturn(null);

        Cache::shouldReceive('put')
            ->once()
            ->with('post_slug_test', Post::class, Carbon::class)
            ->andReturn(Post::class);

        $retrieved_post = Post::getBySlug('test');

        $this->assertEquals($post->id, $retrieved_post->id);
    }

    public function testGetBySlugReturnsNullIfNoPostFound()
    {
        Cache::shouldReceive('get')
            ->with('post_slug_test')
            ->andReturn(null);

        $retrieved_post = Post::getBySlug('test');

        $this->assertNull($retrieved_post);
    }
}
