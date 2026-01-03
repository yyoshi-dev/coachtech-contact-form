@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/contact.css')}}">
@endsection

@section('header-nav')
@endsection

@section('title', 'Contact')

@section('content')
<div class="content">
    <form action="/confirm" method="post" class="form" novalidate>
        @csrf
        {{-- お名前 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content name-field">
                <div class="form__input--text">
                    <input type="text" name="last_name" value="{{old('last_name', request('last_name'))}}" placeholder="例: 山田">
                    @error('last_name')
                        <p class="form__error">{{$message}}</p>
                    @enderror
                </div>
                <div class="form__input--text">
                    <input type="text" name="first_name" value="{{old('first_name', request('first_name'))}}" placeholder="例: 太郎">
                    @error('first_name')
                        <p class="form__error">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 性別 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="gender-field">
                    <div class="form__radio">
                        <label>
                            <input type="radio" name="gender" value="1" {{old('gender', request('gender')) == 1 ? 'checked' : ''}}>
                            男性
                        </label>
                    </div>
                    <div class="form__radio">
                        <label>
                            <input type="radio" name="gender" value="2" {{old('gender', request('gender')) == 2 ? 'checked' : ''}}>
                            女性
                        </label>
                    </div>
                    <div class="form__radio">
                        <label>
                            <input type="radio" name="gender" value="3" {{old('gender', request('gender')) == 3 ? 'checked' : ''}}>
                            その他
                        </label>
                    </div>
                </div>
                @error('gender')
                    <p class="form__error">{{$message}}</p>
                @enderror
            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" value="{{old('email', request('email'))}}" placeholder="例: test@example.com">
                    @error('email')
                        <p class="form__error">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content tel-field">
                <div class="form__input--text">
                    <input type="text" name="tel1" value="{{old('tel1', request('tel1'))}}" placeholder="080">
                    @error('tel1')
                        <p class="form__error">{{$message}}</p>
                    @enderror
                </div>
                <span class="tel__hyphen">-</span>
                <div class="form__input--text">
                    <input type="text" name="tel2" value="{{old('tel2', request('tel2'))}}" placeholder="1234">
                    @error('tel2')
                        <p class="form__error">{{$message}}</p>
                    @enderror
                </div>
                <span class="tel__hyphen">-</span>
                <div class="form__input--text">
                    <input type="text" name="tel3" value="{{old('tel3', request('tel3'))}}" placeholder="5678">
                    @error('tel3')
                        <p class="form__error">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" value="{{old('address', request('address'))}}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                    @error('address')
                        <p class="form__error">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 建物名 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
                <span class="form__label--required"></span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" value="{{old('building', request('building'))}}" placeholder="例: 千駄ヶ谷マンション101">
                    @error('building')
                        <p class="form__error">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content category-field">
                <div class="form__input--select">
                    <select name="category_id">
                        <option value="" disabled selected>選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}>
                                {{$category->content}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <p class="form__error">{{$message}}</p>
                @enderror
            </div>
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form__group form__group--textarea">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', request('detail')) }}</textarea>
                    @error('detail')
                        <p class="form__error">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 確認画面ボタン --}}
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>

@endsection