<?php

use Illuminate\Support\Facades\Route;

Route::get(config('nova-simple-content.post_list_url', '/blog'), 'Carlson\NovaSimpleContent\Http\Controllers\Post\PostController@list')
    ->name('blog');
Route::get(config('nova-simple-content.post_detail_slug_prefix', '/blog').'/{slug}', 'Carlson\NovaSimpleContent\Http\Controllers\Post\PostController@detail')
    ->name('blogDetail');

Route::get(config('nova-simple-content.page_slug_prefix', '/content').'/{slug}', 'Carlson\NovaSimpleContent\Http\Controllers\Page\PageController@index');