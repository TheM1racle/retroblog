@extends('layouts.app')

@section('title', 'Вход для администратора')

@section('content')
    <h1>Admin Login</h1>
    <p class="meta">Вход только для владельца блога</p>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="remember"> Запомнить меня
            </label>
        </div>

        <button type="submit" class="btn">Войти</button>
    </form>
@endsection
