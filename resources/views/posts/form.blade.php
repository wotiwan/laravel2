@extends('layouts.app')

@section('content')
<h1>{{ isset($post) ? 'Edit Post' : 'Add Post' }}</h1>

<form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST">
    @csrf
    @if(isset($post))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" rows="5" class="form-control" required>{{ old('content', $post->content ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="" disabled selected>Select Category</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ isset($post) && $post->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($post) ? 'Update' : 'Save' }}</button>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
