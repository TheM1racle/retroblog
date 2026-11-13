@extends('layouts.app')

@section('title', $post->exists ? 'Редактировать запись' : 'Новая запись')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('blog') }}">Home</a> ▸ <span>{{ $post->exists ? 'Edit Post' : 'New Post' }}</span>
    </div>

    <h1>{{ $post->exists ? 'Редактировать запись' : 'Новая запись' }}</h1>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ $post->exists ? route('posts.update', $post) : route('posts.store') }}" method="POST">
        @csrf
        @if($post->exists)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required placeholder="You Are NOT Dumb, You Just Lack the Prerequisites">
        </div>

        <div class="form-group">
            <label for="category">Раздел</label>
            <select id="category" name="category">
                <option value="blog" {{ old('category', $post->category) === 'blog' ? 'selected' : '' }}>Blog</option>
                <option value="progress-reports" {{ old('category', $post->category) === 'progress-reports' ? 'selected' : '' }}>Progress-Reports</option>
            </select>
        </div>

        <div class="form-group">
            <label for="content">Текст (поддерживается Markdown: **жирный**, *курсив*, списки, код)</label>
            <textarea id="content" name="content" rows="14" required placeholder="Пиши текст здесь...">{{ old('content', $post->content) }}</textarea>
        </div>

        <button type="submit" class="btn">{{ $post->exists ? 'Сохранить изменения' : 'Опубликовать' }}</button>
    </form>
@endsection
