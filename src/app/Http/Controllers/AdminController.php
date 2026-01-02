<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    // お問い合わせ一覧表示
    public function index()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('admin.index', compact('contacts', 'categories'));
    }

    // 検索処理
    public function search(Request $request)
    {
        $query = Contact::query();
        // 名前、メールアドレスの検索
        if ($request->filled('name_or_email')) {
            $keyword = $request->name_or_email;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")->orWhere('first_name', 'like', "%{$keyword}%")->orWhere('email', 'like', "%{$keyword}%")->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"]);
            });
        }
        // 性別の検索
        if ($request->filled('gender') && $request->gender !== '0') {
            $query->where('gender', $request->gender);
        }
        // お問い合わせの種類の検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }
        // 日付の検索
        $contacts = $query->paginate(7)->withQueryString();
        $categories = Category::all();
        return view('admin.index', compact('contacts', 'categories'));
    }

    // リセット処理
    public function reset()
    {
        return redirect('/admin');
    }

    // エクスポート処理
    public function export(Request $request) {}


    // 削除処理
    public function destroy(Request $request)
    {
        $contact = Contact::find($request->id);
        if ($contact) {
            $contact->delete();
        }
        return redirect('/admin');
    }
}
