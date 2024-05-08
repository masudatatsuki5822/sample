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
    
</div>
<div class="letter_box">
<table class="one_contact">
    
        <tr>
            <th>今日の日付</th>
        </tr>
        <tr>
            @foreach($todayList as $today)
            <td>{{ $today }}</td>
            @endforeach
        </tr>
        <tr>
            <th>お迎え時刻</th>
        </tr>
        <tr>
            @foreach($back_timeList as $back_time)
            <td>{{ $back_time }}</td>
            @endforeach
        </tr>
        @foreach($contacts_all as $contacts)
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
        
        <tr>
            <th>コメント</th>
        </tr>
        <tr>
            <td>{{ $contacts->comment}}</td>
        </tr>
        
    @endforeach
    </table>


    <div class='registerBox'>
        <input class="back "type="button" onclick="window.history.back();" value="クラスの生徒一覧にもどる">
        <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
    </div>
</div>

@elseif('student')
<div class="text">
    <h1>生徒 {{ $studentName[0]->name }}さん</h1> 
    <h2>連絡帳確認</h2>
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
    <div class='registerBox'>
        <a href="{{ route ('index')}}">生徒マイページへ戻る</a>
    </div>
</div>
@endif



</body>
</html>