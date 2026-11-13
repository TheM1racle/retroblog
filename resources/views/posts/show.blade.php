@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('blog') }}">Home</a> ▸
        @if($post->category === 'progress-reports')
            <a href="{{ route('progress') }}">Progress-Reports</a>
        @else
            <a href="{{ route('blog') }}">Blog</a>
        @endif
        ▸ <span>Current Page</span>
    </div>

    <h1>{{ $post->title }}</h1>

    <div class="meta">
        {{ $post->created_at->format('M d, Y') }} / Read time: {{ $post->read_time }} min
    </div>

    <article class="content">
        {!! $post->html_content !!}
    </article>

    @auth
        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px dashed var(--border); display: flex; gap: 12px;">
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline">Редактировать</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Удалить этот пост?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </div>
    @endauth
@endsection
