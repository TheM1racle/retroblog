<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('category', 'blog')->latest()->get();
        return view('posts.index', [
            'posts' => $posts,
            'sectionTitle' => 'Blog',
            'category' => 'blog',
        ]);
    }

    public function progressReports()
    {
        $posts = Post::where('category', 'progress-reports')->latest()->get();
        return view('posts.index', [
            'posts' => $posts,
            'sectionTitle' => 'Progress-Reports',
            'category' => 'progress-reports',
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.form', ['post' => new Post()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:blog,progress-reports'],
            'content' => ['required', 'string'],
        ]);

        $baseSlug = Str::slug($data['title']) ?: 'post';
        $slug = $baseSlug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $post = Post::create([
            'title' => $data['title'],
            'slug' => $slug,
            'category' => $data['category'],
            'content' => $data['content'],
        ]);

        return redirect()->route('posts.show', $post);
    }

    public function edit(Post $post)
    {
        return view('posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:blog,progress-reports'],
            'content' => ['required', 'string'],
        ]);

        $post->update($data);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $category = $post->category;
        $post->delete();

        return redirect()->route($category === 'progress-reports' ? 'progress' : 'blog');
    }
}
