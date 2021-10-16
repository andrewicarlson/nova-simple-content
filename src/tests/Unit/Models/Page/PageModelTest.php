<?php

namespace Tests\Unit\Models\Page;

use Carlson\NovaSimpleContent\Models\Page;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class PageModelTest extends TestCase
{
    use RefreshDatabase;

    public function testCacheBySlugReceivesPage()
    {
        $page = new Page();
        $page->title = "Test";
        $page->body = "Test body";
        $page->slug = "test";
        $page->seo_title = "Test SEO title";
        $page->seo_description = "Test SEO description";
        $page->save();

        Cache::shouldReceive('put')
            ->once()
            ->with('page_slug_test', Page::class, Carbon::class)
            ->andReturn(Page::class);

        Page::cacheBySlug($page);
    }

    public function testGetBySlugReturnsPageIfInCache()
    {
        $page = new Page();
        $page->title = "Test";
        $page->body = "Test body";
        $page->slug = "test";
        $page->seo_title = "Test SEO title";
        $page->seo_description = "Test SEO description";
        $page->save();

        Page::cacheBySlug($page);

        Cache::shouldReceive('get')
            ->with('page_slug_test')
            ->andReturn($page);

        Page::getBySlug( 'test');
    }

    public function testGetBySlugReturnsPageFromDBIfExistsButCacheDisabled()
    {
        Config::set('nova-simple-content.cache_pages', false);

        $page = new Page();
        $page->title = "Test";
        $page->body = "Test body";
        $page->slug = "test";
        $page->seo_title = "Test SEO title";
        $page->seo_description = "Test SEO description";
        $page->save();


        Cache::shouldReceive('get')
            ->never();

        $retrieved_page = Page::getBySlug('test');

        $this->assertEquals($page->id, $retrieved_page->id);
    }

    public function testGetBySlugReturnsPageFromDBIfExistsButNotInCache()
    {
        $page = new Page();
        $page->title = "Test";
        $page->body = "Test body";
        $page->slug = "test";
        $page->seo_title = "Test SEO title";
        $page->seo_description = "Test SEO description";
        $page->save();

        Cache::shouldReceive('get')
            ->with('page_slug_test')
            ->andReturn(null);

        Cache::shouldReceive('put')
            ->once()
            ->with('page_slug_test', Page::class, Carbon::class)
            ->andReturn(Page::class);

        $retrieved_page = Page::getBySlug('test');

        $this->assertEquals($page->id, $retrieved_page->id);
    }

    public function testGetBySlugReturnsNullIfNoPageFound()
    {
        Cache::shouldReceive('get')
            ->with('page_slug_test')
            ->andReturn(null);

        $retrieved_page = Page::getBySlug('test');

        $this->assertNull($retrieved_page);
    }
}
