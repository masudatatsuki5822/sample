<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/letter_style.css') }}">
    <title>保育園 連絡帳確認</title>
</head>

<body>
<div class="letter_box">
    <h1>{{ $nursery[0]->name }} {{ $contacts->name }}さん 連絡帳確認</h1>
        <table class="contents">

            <tr>
                <th>今日の日付</th>
            </tr>
            <tr>
                <td>{{ $today }}</td>
            </tr>
            <tr>
                <th>お迎え時刻</th>
            </tr>
            <tr>
                <td>{{ $back_time }}</td>
            </tr>
            <tr>
                <th>体温</th>
            </tr>
            <tr>
                <td>{{ $contacts->temp }}</td>
            </tr>
            <tr>
                <th>朝食内容</th>
            </tr>
            <tr>
                <td>{{ $contacts->breakfast }}</td>
            </tr>
            @if($contacts->comment)
            <tr>
                <th>コメント</th>
            </tr>
            <tr>
                <td>{{ $contacts->comment}}</td>
            </tr>
            @endif
        </table>

        <div class='registerBox'>
            <input class="back "type="button" onclick="window.history.back();" value="クラスの生徒一覧にもどる">
            <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
        </div>
    </form>
</div>
</body>
</html>