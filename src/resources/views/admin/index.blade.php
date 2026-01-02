@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('header-nav')
<div class="logout__link">
	<form action="/logout" method="POST" class="logout-form">
        @csrf
        <button class="logout-form__button">logout</button>
	</form>
</div>
@endsection

@section('title', 'Admin')

@section('content')
<div class="content">
    {{-- 検索パート --}}
    <div class="search">
        <form action="/search" method="get" class="search-form">
            <div class="search-form__content">
                <div class="search-form__item">
                    <input
                        type="text"
                        name="name_or_email"
                        class="search-form__item-input"
                        value="{{request('name_or_email')}}"
                        placeholder="名前やメールアドレスを入力してください"
                    >
                </div>
                <div class="search-form__item">
                    <select name="gender" class="search-form__item-select">
                        <option value="" disabled selected>性別</option>
                        <option value="1" {{request('gender') == '1' ? 'selected' : ''}}>男性</option>
                        <option value="2" {{request('gender') == '2' ? 'selected' : ''}}>女性</option>
                        <option value="3" {{request('gender') == '3' ? 'selected' : ''}}>その他</option>
                    </select>
                </div>
                <div class="search-form__item">
                    <select name="category_id" class="search-form__item-select">
                        <option value="" disabled selected>お問い合わせの種類</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{request('category_id') == $category->id ? 'selected' : ''}}>
                                {{$category->content}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="search-form__item">
                    <input
                        type="date"
                        name="date"
                        class="search-form__item-input"
                        value="{{request('date')}}"
                        placeholder="年/月/日"
                    >
                </div>
                <div class="search-form__button">
                    <button class="search-form__button-submit" type="submit">検索</button>
                </div>
                <div class="search-form__button">
                    <button class="search-form__button-reset" type="reset" onclick="location.href='/reset'">リセット</button>
                </div>
            </div>
        </form>
    </div>

    {{-- エクスポート、ページネーション --}}
    <div class="utilities">
        <form action="/export" method="get" class="export-form">
            @foreach(request()->query() as $key => $value)
                <input type="hidden" name="{{$key}}" value="{{$value}}">
            @endforeach
            <button class="export-form__submit">エクスポート</button>
        </form>
        <div class="admin-pagination">
            {{$contacts->links('vendor.pagination.tailwind')}}
        </div>
    </div>

    {{-- お問い合わせ内容一覧 --}}
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header">お問い合わせの種類</th>
                <th class="contact-table__header"></th>
            </tr>
            @foreach ($contacts as $contact)
                <tr class="contact-table__row">
                    <td class="contact-table__item">{{$contact->full_name}}</td>
                    <td class="contact-table__item">{{$contact->gender_label}}</td>
                    <td class="contact-table__item">{{$contact->email}}</td>
                    <td class="contact-table__item">{{$contact->category->content}}</td>
                    <td class="contact-table__item">
                        <a href="#modal-{{$contact->id}}" class="detail-button">詳細</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    {{-- モーダル --}}
    @foreach ($contacts as $contact)
        <div id="modal-{{$contact->id}}" class="modal">
            <div class="modal__content">
                <a href="#" class="modal__close">×</a>
                <div class="modal__group">
                    <div class="modal__group-title">
                        <span class="modal__group-title-text">お名前</span>
                    </div>
                    <div class="modal__group-content">
                        <span class="modal__group-content-item">{{$contact->full_name}}</span>
                    </div>
                </div>
                <div class="modal__group">
                    <div class="modal__group-title">
                        <span class="modal__group-title-text">性別</span>
                    </div>
                    <div class="modal__group-content">
                        <span class="modal__group-content-item">{{$contact->gender_label}}</span>
                    </div>
                </div>
                <div class="modal__group">
                    <div class="modal__group-title">
                        <span class="modal__group-title-text">メールアドレス</span>
                    </div>
                    <div class="modal__group-content">
                        <span class="modal__group-content-item">{{$contact->email}}</span>
                    </div>
                </div>
                <div class="modal__group">
                    <div class="modal__group-title">
                        <span class="modal__group-title-text">電話番号</span>
                    </div>
                    <div class="modal__group-content">
                        <span class="modal__group-content-item">{{$contact->tel}}</span>
                    </div>
                </div>
                <div class="modal__group">
                    <div class="modal__group-title">
                        <span class="modal__group-title-text">住所</span>
                    </div>
                    <div class="modal__group-content">
                        <span class="modal__group-content-item">{{$contact->address}}</span>
                    </div>
                </div>
                <div class="modal__group">
                    <div class="modal__group-title">
                        <span class="modal__group-title-text">建物名</span>
                    </div>
                    <div class="modal__group-content">
                        <span class="modal__group-content-item">{{$contact->building}}</span>
                    </div>
                </div>
                <div class="modal__group">
                    <div class="modal__group-title">
                        <span class="modal__group-title-text">お問い合わせの種類</span>
                    </div>
                    <div class="modal__group-content">
                        <span class="modal__group-content-item">{{$contact->category->content}}</span>
                    </div>
                </div>
                <div class="modal__group">
                    <div class="modal__group-title">
                        <span class="modal__group-title-text">お問い合わせ内容</span>
                    </div>
                    <div class="modal__group-content">
                        <span class="modal__group-content-item">{{$contact->detail}}</span>
                    </div>
                </div>
                <form action="/delete" method="post" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <div class="delete-form__button">
                        <input type="hidden" name="id" value="{{$contact->id}}">
                        <button class="delete-form__button-submit" type="submit">削除</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection