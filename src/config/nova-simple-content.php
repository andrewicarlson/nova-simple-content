<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cache Posts
    |--------------------------------------------------------------------------
    |
    | This value determines whether the Post Model will attempt to interact
    | with content from the applications configured cache.
    |
    | If you have not configured caching it is recommended that this be changed to
    | false.
    |
    */

    'cache_posts' => true,

    /*
    |--------------------------------------------------------------------------
    | Cache Pages
    |--------------------------------------------------------------------------
    |
    | This value determines whether the Page Model will attempt to interact
    | with content from the applications configured cache.
    |
    | If you have not configured caching it is recommended that this be changed to
    | false.
    |
    */

    'cache_pages' => true,

    /*
    |--------------------------------------------------------------------------
    | Post List URL
    |--------------------------------------------------------------------------
    |
    | This value determines the page route for the list page for posts.
    |
    |
    */

    'post_list_url' => '/blog',

    /*
    |--------------------------------------------------------------------------
    | Post Slug Prefix
    |--------------------------------------------------------------------------
    |
    | This value determines the prefix all post routes.
    |
    | E.g., /blog in /blog/test-post
    |
    */

    'post_detail_slug_prefix' => '/blog',

    /*
    |--------------------------------------------------------------------------
    | Page Slug Prefix
    |--------------------------------------------------------------------------
    |
    | This value determines the prefix all page routes.
    |
    | E.g., /content in /content/test-page
    |
    */

    'page_slug_prefix' => '/content',

];
