@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}</h1>

<p><strong>Category:</strong> {{ $post->category->name }}</p>
<p>{{ $post->content }}</p>

<a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
@endsection
