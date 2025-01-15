@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Главная страница</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->content }}</p>
                    <p><strong>Категория:</strong> {{ $post->category->name }}</p>
                </div>
                <div class="card-footer">
                    <h4>Комментарии:</h4>
                    @forelse($post->comments as $comment)
                        <div class="mb-2">
                            <strong>{{ $comment->author }}:</strong>
                            <p>{{ $comment->content }}</p>
                        </div>
                    @empty
                        <p>Комментариев пока нет.</p>
                    @endforelse

                    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-2">
                            <label for="author_name">Ваше имя:</label>
                            <input type="text" name="author" id="author" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="content">Ваш комментарий:</label>
                            <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
