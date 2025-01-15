@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Все комментарии</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Автор</th>
                    <th>Комментарий</th>
                    <th>Пост</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->author }}</td>
                        <td>{{ $comment->content }}</td>
                        <td><a href="{{ route('posts.show', $comment->post) }}">{{ $comment->post->title }}</a></td>
                        <td>
                            @if ($comment->is_approved)
                                <span class="badge bg-success">Одобрен</span>
                            @else
                                <span class="badge bg-warning">На модерации</span>
                            @endif
                        </td>
                        <td>
                            @if (!$comment->is_approved)
                                <form action="{{ route('comments.approve', $comment) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Одобрить</button>
                                </form>
                            @endif

                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
