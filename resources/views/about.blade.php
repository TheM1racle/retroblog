@extends('layouts.app')

@section('title', 'About')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('blog') }}">Home</a> ▸ <span>About</span>
    </div>

    <h1>About</h1>
    <div class="meta">Личный уголок в сети</div>

    <div class="content">
        <p>Привет! Это мой минималистичный блог и журнал прогресса.</p>
        <p>Здесь я публикую заметки об обучении, программировании и личных проектах без лишнего информационного шума.</p>
    </div>
@endsection
