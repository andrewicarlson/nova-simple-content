<?php

namespace Carlson\NovaSimpleContent\Http\Controllers\Post;

use Carlson\NovaSimpleContent\Http\Controllers\Controller;
use Carlson\NovaSimpleContent\Models\Post;

class PostController extends Controller
{
    public function list()
    {
        return view('nova-simple-content::posts.list')->with(['posts' =>
            Post::where('published', 1)
                ->where('published_on', '<=', date('Y-m-d H:i:s'))
                ->latest('published_on')
                ->get()
        ]);
    }

    public function detail($slug)
    {
        $post = Post::getBySlug($slug);

        if ($post) {
            return view('nova-simple-content::posts.detail')->with(['post' => $post]);
        }

        return abort(404);
    }
}