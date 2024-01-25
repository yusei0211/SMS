@extends('owner.layout')
@section('title', '利用者一覧')
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h2>利用者一覧</h2>
        @if (session('err_msg'))
            <p class="text-danger">
                {{ session('err_msg') }}
            </p>
        @endif
        <table class="table table-striped">
            <tr>
                <th>利用者ID</th>
                <th>利用者名</th>
                <th>メールアドレス</th>
                <th></th>
                <th>削除</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td><a href="/user/{{ $user->id }}">{{ $user->email }}</a></td>
                    <td>
                        @if ($user->trashed())
                            <span class="text-danger">削除済み</span>
                        @endif
                    </td>
                    @if ($user->trashed())
                        <form method="POST" action="{{ route('owner.userRestore', $user->id) }}" onSubmit="return checkRestore()">
                        @csrf
                        <td><button type="submit" class="btn btn-primary" onclick=>復元</button></td>
                        </form>
                    @else
                        <form method="POST" action="{{ route('owner.userDelete', $user->id) }}" onSubmit="return checkDelete()">
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