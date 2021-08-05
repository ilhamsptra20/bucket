@extends('layouts/app')
@section('content')
    <div class="container">
        <h3>{{$post->title}}</h3>
        <div class="text-secondary">
            <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a> 
            &middot; {{$post->created_at->format('d F, Y')}} 
            &middot; 
            @foreach ($post->tags as $tag)
                <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>    
            @endforeach
        </div>
        
        <hr class="m-0">
        
        <div class="text-secondary mt-2 mb-5">
            {{$post->user->name}}
        </div>
        
        <p>{!! nl2br($post->content)!!}</p>
        <!-- Button trigger modal -->
        @can('update', $post)
            <button type="button" class="btn btn-link btn-sm text-danger p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Delete
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin Mau Menghapusnya ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/posts/{{$post->slug}}/delete" method="post">
                            @csrf
                            @method('delete')
                            <strong>{{$post->title}}</strong>
                            <div class="text-secondary mb-1">
                                <small>Published: {{$post->created_at}}</small>
                            </div>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endcan    
        </div>
    </div>
@endsection