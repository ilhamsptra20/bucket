<?php

namespace App\Http\Controllers;

use App\Models\{Post, Tag, Category, User};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index', [
            'posts'=>Post::latest()->simplePaginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create', [
            'categories' => Category::get(),
            'tags' => Tag::get(),
            'post' => new Post(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request()->file('thumbnail'));
        $attr = request()->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
            'category' => 'required',
            'tags' => 'required',
        ]);
        
        $thumbnail = request()->file('thumbnail');
        $thumbnailurl = $thumbnail->store('images/posts');
        $attr['thumbnail'] = $thumbnailurl;

        // Create slug
        $attr['slug'] = Str::slug($attr['title']);
        $attr['category_id'] = request('category');

        // create new post
        $post = auth()->user()->posts()->create($attr);

        $post->tags()->attach(request('tags'));
        
        // alert
        session()->flash('success', 'The Post was created');

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',[
            'pots' => $post,
            'category' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $attr = request()->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
        ]);
        $attr['category_id'] = request('category');

        $post->update($attr);
        
        $post->tags()->sync(request('tags'));

        
        session()->flash('success', 'The Post was updated');

        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('update', $post);
        $post->tags()->detach();
        $post->delete();
        
        session()->flash('success', 'The Post was Deleted');
        
        return redirect('posts');
    }
}
