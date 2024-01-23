<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    //テーブル名
    protected $table = 'blogs';

    // 可変項目
    protected $fillable =
    [
        'user_id',
        'title',
        'content'
    ];
    // ユーザーとのリレーションシップ
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}