@extends('user.layout')
@section('title', 'ブログ一覧')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <h2>投稿一覧</h2>
            @if (session('err_msg'))
                <p class="text-danger">
                    {{ session('err_msg') }}
                </p>
            @endif
            <table class="table table-striped">
                <tr>
                    <th>タイトル</th>
                    <th>内容</th>
                    <th>日付</th>
                    
                </tr>
                @foreach($blogs as $blog)
                    <tr>
                        <td><a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></td>
                        <td>{{ $blog->content }}</td>
                        <td>{{ $blog->updated_at }}</td>
                        
                        @if(Auth::check() && $blog->user_id == Auth::id())
                        
                        <td><button type="button" class="btn btn-primary" onclick="location.href='/blog/edit/{{ $blog->id }}'">編集</button></td>
                        <td>
                            <form method="POST" action="{{ route('user.delete', $blog->id) }}" onSubmit="return checkDelete()">
                                @csrf
                                <button type="submit" class="btn btn-primary">削除</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script>
        function checkDelete(){
            if(window.confirm('削除してよろしいですか？')){
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
