<?php

namespace Carlson\NovaSimpleContent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Carlson\NovaSimpleContent\Events\Page\Deleted as DeletedEvent;
use Carlson\NovaSimpleContent\Events\Page\Updated as UpdatedEvent;

class Page extends Model
{
    protected $table = 'carlson_nova_simple_content_pages';
    protected $fillable = [];
    protected $casts = [
        'published_on' => 'datetime'
    ];
    protected $dispatchesEvents = [
        'deleted' => DeletedEvent::class,
        'updated' => UpdatedEvent::class
    ];

    public static function cacheBySlug($page)
    {
        Cache::put("page_slug_{$page->slug}", $page, now()->addMinutes(30));
    }

    public static function getBySlug($slug)
    {
        if (config('nova-simple-content.cache_pages', true) != true) {
            return Page::where('slug', $slug)->first();
        }

        if($page = Cache::get("page_slug_{$slug}")) {
            return $page;
        }

        if($page = Page::where('slug', $slug)->first()) {
            Page::cacheBySlug($page);
            return $page;
        }

        return null;
    }

    public static function forgetBySlug($slug)
    {
        Cache::forget("page_slug_{$slug}");
    }

    public static function cacheAll()
    {
        Cache::put('pages', Page::all(), now()->addMinutes(30));
    }
}
