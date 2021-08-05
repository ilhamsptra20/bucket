<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate(6);
        return view('post.index', compact('posts') , compact('category'));
    }
}
