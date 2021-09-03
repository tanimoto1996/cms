<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Modelにはfindメソッドなどの呼び出しがないので、ここで呼び出せるようにする
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    // $fillableに指定したカラムのみcreate() fill() update() に値が入る
    // guardedは指定していないもの全てが入る = $fillableの逆パターン
    protected $fillable = [
        'title', 'body', 'is_public', 'published_at'
    ];

    // データ取得時に指定した型に変換してくれる
    protected $casts = [
        'is_public' => 'bool',
        'published_at' => 'datetime'
    ];

    // 公開のみ表示
    public function scopePublic(Builder $query)
    {
        return $query->where('is_public', true);
    }

    // 公開記事一覧表示
    public function scopePublicList(Builder $query)
    {
        return $query
            ->public()
            ->latest('published_at')
            ->paginate(10);
    }

    // 公開記事をIDで取得
    public function scopePublicFindById(Builder $query, int $id)
    {
        return $query
            ->public()
            ->findOrFail($id);
    }

    // 公開日を年月日で取得する
    // スネークケースで記述するとviewなどで使用することができる
    // foreachで回している時などに（$post->published_format）で表示することができる
    public function getPublishedFormatAttribute()
    {
        return $this->published_at->format('Y年m月d日');
    }
}
