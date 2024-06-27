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
    <h1>{{ $nursery[0]->name }} 生徒一覧</h1>
    <h2>
        {{ $students[0] ->years}}歳児
        {{ $students[0] ->className}}クラス
    </h2>
</div>


<table class='all'>
    <tr>
        <th>生徒名</th>
        <th></th>
        <th></th>
    </tr>

    @foreach($students as $student)
    <tr>
        <td>{{ $student->studentName }}さん</td>
        <td><button class="detail"onclick="location.href='/contact/show/{{ $student->id }}'">連絡帳を確認</button></td>
        <td><button class="before"onclick="location.href='/contact/show/before/{{ $student->id }}'">過去の分を確認</button></td>
    </tr>
    @endforeach



</table>


<div class="registerBox">
    <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
</div>


</body>
</html>