@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endsection

@section('header-nav')
<div class="register__link">
    <a href="/register" class="register__button-submit">register</a>
</div>
@endsection

@section('title', 'Login')

@section('content')
<div class="content">
    <form action="/login" method="post" class="form" novalidate>
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">メールアドレス</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" value="{{old('email')}}" placeholder="例: test@example.com">
                </div>
                <div class="form__error">
                    @error('email')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">パスワード</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="例: coachtech1106">
                </div>
                <div class="form__error">
                    @error('password')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>

@endsection