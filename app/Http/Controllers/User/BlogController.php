<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User; //追記
use Illuminate\Support\Facades\Auth; //追記

class BlogController extends Controller
{
    /*
    blog一覧の表示
      @param int $id
      @return view
    */
    public function showList()
    {
        $blogs = Blog::all();

        //dd($blogs);

      return view('user.blog.list',['blogs'=> $blogs]);
    }

    //ブログ詳細
    public function showDetail($id)
    {
      $blog = Blog::find($id);

        //dd($blogs);
      if(is_null($blog)){
        \Session::flash('err_msg','データがありません');
        return redirect(route('user.blogs'));
      }

      //return view('blog.detail',['blogs'=> $blog]);
      return view('user.blog.detail')->with('blog', $blog);
    }

    //blog登録画面の表示
    public function showCreate() {
        return view('user.blog.form');
    }

    // blogの投稿
public function exeStore(BlogRequest $request) 
{
    // ログイン中のユーザーに関連づけてデータを受け取る
    $user = Auth::user();
    $inputs = ['user_id' => $user->id, 'title' => $request->title, 'content' => $request->content];

    // トランザクション処理
    \DB::beginTransaction();
    try {
        // ブログ投稿
        Blog::create($inputs);
        \DB::commit();
    } catch (\Throwable $e) {
        \DB::rollback();
        abort(500);
    }
    
    \Session::flash('success_msg', 'ブログを登録しました');
    return redirect(route('user.blogs'));
}

    //ブログ編集フォームを表示
    public function showEdit($id)
    {
      $blog = Blog::find($id);

        //dd($blogs);
      if(is_null($blog)){
        \Session::flash('err_msg','データがありません');
        return redirect(route('user.blogs'));
      }

      //return view('blog.detail',['blogs'=> $blog]);
      return view('user.blog.edit')->with('blog', $blog);
    }

    //blogの更新
    //blogの更新
//blogの更新
public function exeUpdate(BlogRequest $request) 
{
    //dd($request->all());
    //ブログのデータを受け取る
    $inputs = $request->all();

    //トランザクション処理
    \DB::beginTransaction();
    try{
        //ブログ投稿
        $blog = Blog::find($inputs['id']);
        $blog->fill([
            'title' => $inputs['title'],
            'content' => $inputs['content'],
        ]);
        $blog->save();
        \DB::commit();
    } catch(\Throwable $e) {
        \DB::rollback();
        abort(500);
    }
    
    \Session::flash('err_msg','ブログを登録しました');
    return redirect(route('user.blogs'));
}


    //ブログ削除
    public function exeDelete($id)
    {
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません');
            return redirect(route('user.blogs'));
        }

        try {
            Blog::destroy($id);
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect(route('user.blogs'));
    }
}