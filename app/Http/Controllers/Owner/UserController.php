<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  /*
 オーナーの表示
   @param int $id
   @return view
 */
 public function showList()
 {
  $users = User::withTrashed()->get();
  //$blogs = Blog::ALL();
  //dd($users);

  return view('owner.user',['users'=> $users]);
 }
 
 //ブログ論理削除
 public function exeDelete($id)
{
 if (empty($id)) {
     \Session::flash('err_msg', 'データがありません');
     return redirect(route('owner.blogs'));
 }

 try {
     $user = User::withTrashed()->find($id);

     if (!$user) {
         \Session::flash('err_msg', '該当のデータが見つかりません');
         return redirect(route('owner.users'));
     }

     $user->Delete();
     // ソフトデリートが完了した場合のメッセージ
     \Session::flash('message', 'ソフトデリートしました');
 } catch (\Throwable $e) {
     \DB::rollback();
     abort(500);
 }

 return redirect(route('owner.users'));
}

//ブログ復元
public function exeRestore($id)
{
 try {
     $user = User::withTrashed()->find($id);

     if (!$user) {
         \Session::flash('err_msg', '該当のデータが見つかりません');
         return redirect(route('owner.users'));
     }

     $user->restore();

     \Session::flash('message', '復元しました');
 } catch (\Throwable $e) {
     \DB::rollback();
     abort(500);
 }

 return redirect(route('owner.users'));
}
}