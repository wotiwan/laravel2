@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p><strong>Категория:</strong> {{ $post->category->name }}</p>

    <hr>

    <h2>Комментарии</h2>
    @foreach($post->comments as $comment)
        @if($comment->is_approved)
            <div class="mb-3">
                <p><strong>{{ $comment->author }}</strong>: {{ $comment->content }}</p>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                </form>
            </div>
        @endif
    @endforeach

    <hr>

    <h2>Оставить комментарий</h2>
    <form action="{{ route('comments.store', $post) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="author" class="form-label">Ваше имя</label>
            <input type="text" name="author" id="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Комментарий</label>
            <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
