@extends('layouts.app')

@section('title', $sectionTitle)

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('blog') }}">Home</a> ▸ <span>{{ $sectionTitle }}</span>
    </div>

    <h1>{{ $sectionTitle }}</h1>
    <p class="meta">Всего записей: {{ $posts->count() }}</p>

    @if($posts->isEmpty())
        <p style="color: var(--muted);">Записей в этом разделе пока нет.</p>
    @else
        <ul class="post-list">
            @foreach($posts as $post)
                <li class="post-item">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    <span class="post-date">{{ $post->created_at->format('M d, Y') }}</span>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
