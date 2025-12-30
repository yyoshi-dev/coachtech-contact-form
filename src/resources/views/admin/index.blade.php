@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('header-nav')
<div class="logout__link">
	<form action="/logout" method="POST" class="logout-form">
        @csrf
        <button class="logout-form__button">ログアウト</button>
	</form>
</div>
@endsection

@section('title', 'Admin')

@section('content')

@endsection