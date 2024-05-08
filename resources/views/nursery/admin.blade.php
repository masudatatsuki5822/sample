<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/nursery_show_style.css') }}">
    <title>システム管理者 ユーザー一覧</title>
</head>
<body>

<h1>システム管理者 ユーザー一覧</h1>

<table class='all'>
    <tr>
        <th>保育園名</th>
        <th>生徒名</th>
        <th></th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->nn }}</td>
        <td>{{ $user->un }}さん</td>
        <td><form method="POST" action="{{ route('user_delete', $user->id) }}"onsubmit="return checkDelete()">
            @csrf
            <button class='delete' type="submit">削除する</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<div class='registerBox'>
    <a href="{{ route ('index')}}">管理者マイページへ戻る</a>
</div>


<script src="{{ asset('/js/delete.js') }}"></script>
</body>
</html>






