<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function showPosts()
    {
        $posts = Post::with(['category', 'comments' => function ($query) {
            $query->where('is_approved', true);
        }])->latest()->get();

        return view('home', compact('posts'));
    }

    /**
     * Сохраняет новый комментарий.
     */
    public function storeComment(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'author' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        \App\Models\Comment::create([
            'post_id' => $validated['post_id'],
            'author' => $validated['author'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('home')->with('success', 'Ваш комментарий отправлен на модерацию!');
    }


    public function create()
    {
        $categories = Category::all();

        return view('posts.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Пост успешно создан!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.form', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Пост успешно обновлён!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост успешно удалён!');
    }
}
