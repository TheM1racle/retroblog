@extends('layouts.app')

@section('title', 'Создание аккаунта администратора')

@section('content')
    <h1>Регистрация администратора</h1>
    <p class="meta">Эта страница доступна только один раз. После создания аккаунта регистрация закроется.</p>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Имя / Никнейм</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Пароль (минимум 6 символов)</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Повтори пароль</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn">Создать админа и войти</button>
    </form>
@endsection
