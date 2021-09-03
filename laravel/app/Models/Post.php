<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
