<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post')->orderBy('created_at', 'desc')->get();

        return view('comments.index', compact('comments'));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        \Log::info('Request data:', $request->only('author', 'content'));

        $post->comments()->create([
            'author' => $request->author,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Комментарий отправлен на модерацию.');
    }

    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);

        return back()->with('success', 'Комментарий одобрен.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Комментарий удалён.');
    }
}
