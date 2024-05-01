<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/student_style.css') }}">
    <title>保育園 マイページ</title>
</head>
<body>

<h1>生徒 マイページ</h1>

<div class='mypage'>
    <div class='contents'>
        <div class='titleBox'>
            <h3>お便り</h3>
        </div>
        <div class='buttonBox'>
            <button class="my_list" onclick="location.href=' {{ route('letter_show')}} '">お便り一覧を見る</button>
        </div>
    </div>
</div>

<div class="logout">
    <form method ="POST" action="{{ route('logout') }}">
        @csrf
        <button class='logout'>ログアウト</button>
    </form>
</div>

</body>
</html>