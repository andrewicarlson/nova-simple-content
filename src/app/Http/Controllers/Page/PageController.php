<?php

namespace Carlson\NovaSimpleContent\Http\Controllers\Page;

use Carlson\NovaSimpleContent\Http\Controllers\Controller;
use Carlson\NovaSimpleContent\Models\Page;

class PageController extends Controller
{
    public function index($slug)
    {
        $page = Page::getBySlug($slug);

        if($page) {
            return view('nova-simple-content::pages/detail')->with('page', $page);
        }

        return abort(404);
    }
}