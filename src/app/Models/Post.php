<?php

namespace Carlson\NovaSimpleContent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Carlson\NovaSimpleContent\Events\Post\Deleted as DeletedEvent;
use Carlson\NovaSimpleContent\Events\Post\Updated as UpdatedEvent;

class Post extends Model
{
    protected $table = 'carlson_nova_simple_content_posts';
    protected $fillable = [];
    protected $casts = [
        'published_on' => 'datetime'
    ];
    protected $dispatchesEvents = [
        'deleted' => DeletedEvent::class,
        'updated' => UpdatedEvent::class
    ];

    public static function boot()
    {
        /**
         * This method and the body replacement is some Trix editor related hackery that is directly related to the fact that it's an inextensible piece of garbage. If Nova ever adds a real Rich Text Editor this can be stripped out.
         */
        parent::boot();

        self::saving(function ($model) {
            $model->body = preg_replace('[\[\[iframe:(.*?)\]\]]', '<figure data-trix-content-type="undefined" class="attachment attachment--content" data-trix-attachment="{&quot;content&quot;:&quot;<div class=\&quot;p-wysiwyg-video\&quot;><iframe src=\&quot;$1\&quot; frameborder=\&quot;0\&quot; allowfullscreen></iframe></div>&quot;}"><div class="p-wysiwyg-video"><iframe src="$1" frameborder="0" allowfullscreen></iframe></div></figure>', $model->body);

            return $model;
        });
    }

    public static function cacheBySlug($post)
    {
        Cache::put("post_slug_{$post->slug}", $post, now()->addMinutes(30));
    }

    public static function getBySlug($slug)
    {
        if (config('nova-simple-content.cache_posts', true) != true) {
            return Post::where('slug', $slug)->first();
        }

        if($post = Cache::get("post_slug_{$slug}")) {
            return $post;
        }

        if($post = Post::where('slug', $slug)->first()) {
            Post::cacheBySlug($post);
            return $post;
        }

        return null;
    }

    public static function forgetBySlug($slug)
    {
        Cache::forget("post_slug_{$slug}");
    }

    public static function cacheAll()
    {
        Cache::put('posts', Post::all(), now()->addMinutes(30));
    }
}