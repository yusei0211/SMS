@extends('owner.layout')
@section('title', 'ブログ一覧')
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h2>ブログ記事一覧</h2>
        @if (session('err_msg'))
            <p class="text-danger">
                {{ session('err_msg') }}
            </p>
        @endif
        <table class="table table-striped">
            <tr>
                <th>記事番号</th>
                <th>タイトル</th>
                <th>内容</th>
                <th>日付</th>
                <th>いいね</th>
                <th></th>
                <th>削除</th>
            </tr>
            @foreach($blogs as $blog)
                <tr>
                    <td>{{ $blog->id }}</td>
                    <td><a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></td>
                    <td>{{ $blog->content }}</td>
                    <td>{{ $blog->updated_at }}</td>
                    <td>👍{{ $blog->likes->count() }}</td>
                    <td>
                        @if ($blog->trashed())
                            <span class="text-danger">削除済み</span>
                        @endif
                    </td>
                    @if ($blog->trashed())
                        <form method="POST" action="{{ route('owner.blogRestore', $blog->id) }}" onSubmit="return checkRestore()">
                        @csrf
                        <td><button type="submit" class="btn btn-primary" onclick=>復元</button></td>
                        </form>
                    @else
                        <form method="POST" action="{{ route('owner.blogDelete', $blog->id) }}" onSubmit="return checkDelete()">
                        @csrf
                        <td><button type="submit" class="btn btn-danger" onclick=>削除</button></td>
                        </form>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
</div>
<script>
    function checkRestore() {
        if (window.confirm('復元してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
    function checkDelete() {
        if (window.confirm('削除してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection
