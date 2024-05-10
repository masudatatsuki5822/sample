<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/nursery_show_style.css') }}">
    <title>保育園 クラス一覧</title>
</head>
<body>

<div class="text">
    <h1>{{ $nursery[0]->name }}</h1>
    <h2>クラス一覧</h2>
    @if(session('success'))
    <div class="alert">
        <p class="session">{{ session('success') }}</p>
    </div>
    @endif
</div>

<table class='all'>
    <tr>
        <th>クラス名</th>
        <th>学年</th>
        <th>担任の先生</th>
    </tr>
    @foreach($grades as $grade)
    <tr>
        <td>{{ $grade->name }}</td>
        <td>{{ $grade->years }}歳児</td>
        <td>{{ $grade->teacher }}先生</td>
    </tr>
    @endforeach
</table>

<div class="registerBox">
    <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
</div>


</body>
</html>