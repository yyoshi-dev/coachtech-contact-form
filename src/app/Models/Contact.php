<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    // categoriesテーブルとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // フルネーム生成用
    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    // 性別ラベル生成用
    public function getGenderLabelAttribute()
    {
        return match ($this->gender) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        };
    }

    // 検索用ローカルスコープ
    public function scopeAdminSearch($query, $request)
    {
        if ($request->filled('name_or_email')) {
            $keyword = $request->name_or_email;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"]);
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
        // 日付の検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query;
    }

    // CSV出力のヘッダー行
    public static function csvHeader()
    {
        return [
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容'
        ];
    }

    // CSV出力
    public function toCsvRow()
    {
        return [
            $this->full_name,
            $this->gender_label,
            $this->email,
            $this->tel,
            $this->address,
            $this->building,
            optional($this->category)->content,
            $this->detail
        ];
    }
}
