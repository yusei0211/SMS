<?php
//齊藤
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
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
    // いいねとのリレーションシップ
    public function likes()
  {
    return $this->hasMany(Like::class, 'blog_id');
  }

  /**
  * リプライにLIKEを付いているかの判定
  *
  * @return bool true:Likeがついてる false:Likeがついてない
  */
  public function is_liked_by_auth_user()
  {
    $id = Auth::id();

    $likers = array();
    foreach($this->likes as $like) {
      array_push($likers, $like->user_id);
    }

    if (in_array($id, $likers)) {
      return true;
    } else {
      return false;
    }
  }
}