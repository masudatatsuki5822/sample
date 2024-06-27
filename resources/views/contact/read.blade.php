<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/letter_style.css') }}">
    <title>保育園 連絡帳確認</title>
</head>

<body>
@can('nursery')
<div class='text'>
    <h1>{{ $nursery[0]->name }}</h1>
@if(isset($message))
    <p>{{ $message }}</p>
@else
    <h2>{{ $contacts->name }}さん 連絡帳確認</h2>
</div>

<div class="letter_box">
    <table class="one_contact">
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
            <th>お迎えする方</th>
        </tr>
        <tr>
            <td>{{ $contacts->person }}</td>
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
    <form method="POST" action="{{ route('confirmed')}}">
        <button type="submit" id= "checked">確認しました</button>
    </form>
@endif
    <div class='registerBox'>
        <input class="back "type="button" onclick="window.history.back();" value="クラスの生徒一覧にもどる">
        <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
    </div>
</div>

@elseif('student')
<div class="text">
    <h1>生徒 連絡帳確認</h1> 
    <h2>{{ $studentName[0]->name }}さん</h2>
@if(isset($message))
    <p>{{ $message }}</p>
@else
</div>

<div class="letter_box">
    <table class="one_contact">

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
            <th>お迎えする方</th>
        </tr>
        <tr>
            <td>{{ $contact->person }}</td>
        </tr>
        <tr>
            <th>体温</th>
        </tr>
        <tr>
            <td>{{ $contact->temp }}</td>
        </tr>
        <tr>
            <th>朝食内容</th>
        </tr>
        <tr>
            <td>{{ $contact->breakfast }}</td>
        </tr>
        @if($contact->comment)
        <tr>
            <th>コメント</th>
        </tr>
        <tr>
            <td>{{ $contact->comment}}</td>
        </tr>
        @endif
    </table>
@endif
    <div class='registerBox'>
        <a href="{{ route ('index')}}">マイページへ戻る</a>
    </div>
</div>
@endif


<script src="{{ asset('/js/confirmed.js') }}"></script>
</body>
</html>