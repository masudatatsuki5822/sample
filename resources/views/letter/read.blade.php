<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/letter_style.css') }}">
    <title>お便りを読む</title>
</head>

<body>
@can('nursery')
<div class="letter_box">
    <h1>{{ $nursery[0]->name }} マイページ</h1>
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
                    <img src="{{ asset('/storage/images/' . $one_letter->image) }}">
                </td>
            </tr>
            @endif
        </table>

        <div class='registerBox'>
            <button type="submit" class="add" onclick="location.href='{{ route('letter_show') }}'">お便り一覧に戻る</button>
        </div>
</div>


@elseif('student')
<div class="letter_box">
    <h1>生徒 お便りを読む</h1>
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
                    <img src="{{ asset('/storage/images/' . $one_letter->image) }}">
                </td>
            </tr>
            @endif
        </table>

        <div class='registerBox'>
            <button type="submit" class="add" onclick="location.href='{{ route('letter_show') }}'">お便り一覧に戻る</button>
        </div>
</div>
@endif


</body>
</html>