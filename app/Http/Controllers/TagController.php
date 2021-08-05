<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->paginate(6);
        return view('post.index', compact('posts'), compact('tag')); 
    }
}
