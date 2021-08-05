    <div class="mb-3">
        <label for="title" class="form-label">Title Post</label>
        <input type="text" name="title" class="form-control @error('title')is-invalid @enderror" id="title" autocomplete="off" value="{{old('title') ?? $post->title}}">
        @error('title')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="thumbnail" class="form-label">Thumbnail Post</label>
        <input type="file" name="thumbnail" class="form-control @error('thumbnail')is-invalid @enderror" id="thumbnail" autocomplete="off" value="{{old('thumbnail') ?? $post->thumbnail}}">
        @error('thumbnail')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select name="category" class="form-control @error('category')is-invalid @enderror" id="category">
        <option disabled selected>Choose One!</option>
        @foreach ($categories as $category)
            <option {{$category->id == $post->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
        </select>
        @error('category')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
        <select name="tags[]" class=".select2 form-control @error('tags')is-invalid @enderror " id="tags" multiple>
        @foreach ($post->tags as $tag)
            <option selected value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach

        @foreach ($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
        </select>
        @error('tags')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control @error('content')is-invalid @enderror" name="content" id="content" rows="3">{{old('content') ?? $post->content}}</textarea>
        @error('content')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-3">
        <button type="submit" name="submit" class="btn btn-primary">{{request()->is('posts/create')? 'Create' : 'Edit'}}</button>
    </div>