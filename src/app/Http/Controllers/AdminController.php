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
        $contacts = Contact::adminSearch($request)->paginate(7);
        $categories = Category::all();
        return view('admin.index', compact('contacts', 'categories'));
    }

    // リセット処理
    public function reset()
    {
        return redirect('/admin');
    }

    // CSV用エスケープ処理
    private function escapeForCsv($value)
    {
        $value = $value ?? '';
        $value = str_replace('"', '""', $value);
        if (preg_match('/[,"\r\n]/', $value)) {
            $value = '"' . $value . '"';
        }

        return $value;
    }
    // エクスポート処理
    public function export(Request $request)
    {
        $contacts = Contact::adminSearch($request)->get();
        $csv = implode(',', Contact::csvHeader()) . "\n";
        foreach ($contacts as $contact) {
            $row = array_map(fn($v) => $this->escapeForCsv($v), $contact->toCsvRow());
            $csv .= implode(',', $row) . "\n";
        }
        $csv = "\xEF\xBB\xBF" . $csv;

        return response($csv)
            ->header('Content-type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="contacts.csv"');
    }

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
