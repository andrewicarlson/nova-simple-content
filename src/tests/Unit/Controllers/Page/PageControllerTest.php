<?php

namespace Tests\Unit\Controllers\Page;

use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carlson\NovaSimpleContent\Models\Page;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
    }

    public function testControllerIndexReturnsViewIfFound()
    {
        $page = new Page;
        $page->title = "Test";
        $page->body = "Test body";
        $page->slug = "test";
        $page->seo_title = "Test SEO title";
        $page->seo_description = "Test SEO description";
        $page->save();

        $response = $this->get('/content/test');

        $response->assertViewHas('page');
        $response->assertViewIs('nova-simple-content::pages.detail');
    }

    public function testControllerIndexReturns404IfNotFound()
    {
        $response = $this->get('/content/test');

        $response->assertNotFound();
    }
}
