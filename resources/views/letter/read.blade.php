<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/letter_style.css') }}">
    <title>保育園 お便りを見る</title>
</head>

<body>
<div class="letter_box">
    <h1>保育園 お便り</h1>
        <table class="contents">
            <tr>
                <th>配信日</th>
                <td>{{ $one_letter->created_at->format('Y/m/d') }}</td>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>{{ $one_letter->title }}</td>
            </tr>
            <tr>
                <th></th>
                <td>{{ $one_letter->body }}</td>
            </tr>
            @if($one_letter->image)
            <tr>
                <th></th>
                <td>
                    <img src="{{ asset('/storage/images/' . $one_letter->image) }}"  width="300px" >
                </td>
            </tr>
            @endif
        </table>

        <div class='registerBox'>
            <button type="submit" class="add" onclick="location.href='{{ route('letter_show') }}'">お便り一覧に戻る</button>
        </div>

</div>
</body>
</html>