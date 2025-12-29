<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // お問い合わせフォーム入力ページ
    public function index()
    {
        return view('contacts.index');
    }

    // お問い合わせフォーム確認ページ
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        return view('contacts.confirm', compact('contact'));
    }

    // サンクスページ
    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        Contact::create($contact);
        return view('contacts.thanks');
    }
}
