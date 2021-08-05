@extends('layouts/app')
@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card my-3">
        <div class="card-header">
          <h5 class="card-title">Update Post</h5>
        </div>
        <div class="card-body">
          <form action="/posts/{{$post->slug}}/edit" method="POST"  enctype="multipart/form-data">
            @method('patch')
            @csrf
            @include('layouts.components.formControl')
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
