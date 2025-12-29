<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // お問い合わせフォーム入力ページ
    public function index()
    {
        $categories = Category::all();
        return view('contacts.index', compact('categories'));
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
        // $contact['full_name'] = $contact['last_name'] . ' ' . $contact['first_name'];
        $contact['gender_label'] = match ($contact['gender']) {
            '1' => '男性',
            '2' => '女性',
            '3' => 'その他'
        };
        $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];
        $contact['category_name'] = Category::find($contact['category_id'])->content;

        return view('contacts.confirm', compact('contact'));
    }

    // サンクスページ
    public function store(Request $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        Contact::create($contact);
        return view('contacts.thanks');
    }
}
