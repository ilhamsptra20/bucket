@extends('layouts/app')

@section('content')
  <div class="container">
    <div class="d-flex justify-content-between">
        @if(isset($category))
        <h2>Category : {{$category->name}}</h2>
        @elseif(isset($tag))
        <h2>Tag : {{$tag->name}}</h2>
        @else
        <h2>All Post</h2>
        @endif
        <div>
            @auth
            <a href="/posts/create" class="btn btn-success">Create Post</a>
            @else
            <a href="{{route('login')}}" class="btn btn-success">Login to Create Post</a>
            @endauth
        </div>
    </div>
    <hr>
    
    <div class="m-0">
        @include('layouts/components/alert/alert')
    </div>
    
    <div class="row">
        @forelse ($posts as $post)
        <div class="col-md-4">
            <div class="card my-3">
            <div class="card-header">
                <h6 class="card-title">{{$post->title}}</h6>
            </div>
            <img style="object-position: center; object-fit:cover; height:270px;" src="storage/{{$post->thumbnail}}" alt="" class="card-img-top">
                <div class="card-body">
                <p>{{Str::limit($post->content, 100)}}</p>
                <a href="/posts/{{$post->slug}}">Read more</a>
                </div>
                <div class="card-footer d-flex justify-content-between align-content-center">
                Publish on {{$post->created_at->diffForHumans()}}
                @can('update', $post)
                    <a href="/posts/{{$post->slug}}/edit/" class="btn btn-primary btn-sm">Edit</a>
                @endcan
                </div>
            </div>
        </div>
        @empty
          {{session()->flash('errorPost', 'Post not Found')}}
        @endforelse
        {{$posts->links()}}
      </div>
  </div>
@stop