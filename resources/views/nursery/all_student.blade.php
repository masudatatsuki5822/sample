<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/nursery_show_style.css') }}">
    <title>保育園 生徒一覧</title>
</head>
<body>

<div class="text">
    <h1>{{ $nursery[0]->name }}</h1>
    <h2>生徒一覧</h2>
    @if(session('success'))
    <div class="alert">
        <p class="session">{{ session('success') }}</p>
    </div>
    @endif
</div>

<table class='all'>
    <tr>
        <th>学年</th>
        <th>クラス名</th>
        <th>生徒名</th>
    </tr>

    @foreach($students as $student)
    <tr>
        <td>{{ $student->years }}歳児</td>
        <td>{{ $student->classname }}</td>
        <td>{{ $student->studentname }}さん</td>
    </tr>
    @endforeach
</table>

<div class="registerBox">
    <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
</div>


</body>
</html>