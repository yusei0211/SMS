<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
  /*
 オーナーの表示
   @param int $id
   @return view
 */
 public function showList()
 {
  $blogs = Blog::withTrashed()->get();
  //$blogs = Blog::ALL();
  //dd($blogs);

  return view('owner.blog',['blogs'=> $blogs]);
 }
 
 //ブログ論理削除
 public function exeDelete($id)
{
 if (empty($id)) {
     \Session::flash('err_msg', 'データがありません');
     return redirect(route('owner.blogs'));
 }

 try {
     $blog = Blog::withTrashed()->find($id);

     if (!$blog) {
         \Session::flash('err_msg', '該当のデータが見つかりません');
         return redirect(route('owner.blogs'));
     }

     $blog->Delete();
     // ソフトデリートが完了した場合のメッセージ
     \Session::flash('message', 'ソフトデリートしました');
 } catch (\Throwable $e) {
     \DB::rollback();
     abort(500);
 }

 return redirect(route('owner.blogs'));
}

//ブログ復元
public function exeRestore($id)
{
 try {
     $blog = Blog::withTrashed()->find($id);

     if (!$blog) {
         \Session::flash('err_msg', '該当のデータが見つかりません');
         return redirect(route('owner.blogs'));
     }

     $blog->restore();

     \Session::flash('message', '復元しました');
 } catch (\Throwable $e) {
     \DB::rollback();
     abort(500);
 }

 return redirect(route('owner.blogs'));
}
}