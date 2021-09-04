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

    // 投稿した記事とユーザー情報を紐づける
    // もし、紐づけるテーブルのカラムがIDじゃない場合は、第２引数に指定する。
    public function user()
    {
        // Userに所属する（紐づける）
        return $this->belongsTo(User::class);
    }

    // savingイベントでuser_idを保存する
    protected static function boot()
    {
        parent::boot();

        // 保存時user_idをログインユーザーに設定
        self::saving(function ($post) {
            $post->user_id = \Auth::id();
        });
    }
}
