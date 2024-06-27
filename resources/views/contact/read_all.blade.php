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
    <h2>{{ $contacts_all[0]->name }}さん 連絡帳確認</h2>
</div>
<div class="letter_box">

@foreach($contacts_all as $contacts)
<table class="one_contact">
        <tr>
            <th>今日の日付</th>
        </tr>
        <tr>

            <td>{{\Carbon\Carbon::parse($contacts->today)->format("Y年m月d日")}}</td>
            

        </tr>
        <tr>
            <th>お迎え時刻</th>
        </tr>
        <tr>

            <td>{{\Carbon\Carbon::parse($contacts->back_time)->format("H時i分")}}</td>

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
        
        <tr>
            <th>コメント</th>
        </tr>
        <tr>
            <td>{{ $contacts->comment}}</td>
        </tr>
    </table>
@endforeach
@endif
    <div class='registerBox'>
        <input class="back "type="button" onclick="window.history.back();" value="クラスの生徒一覧にもどる">
        <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
    </div>
</div>

@elseif('student')
<div class="text">
    <h1>生徒 {{ $studentName[0]->name }}さん</h1> 
    <h2>連絡帳確認</h2>
@if(isset($message))
        <p>{{ $message }}</p>
@else
</div>
<div class="letter_box">
    @foreach($contact as $before_contact)
    <table class="one_contact">
    
        <tr>
            <th>日付</th>
        </tr>
        <tr>
            <td>{{\Carbon\Carbon::parse($before_contact->today)->format("Y年m月d日")}}</td>
        </tr>
        <tr>
            <th>お迎え時刻</th>
        </tr>
        <tr>
            <td>{{\Carbon\Carbon::parse($before_contact->back_time)->format("H時i分")}}</td>
        </tr>
        <tr>
            <th>お迎えする方</th>
        </tr>
        <tr>
            <td>{{ $before_contact->person }}</td>
        </tr>
        <tr>
            <th>体温</th>
        </tr>
        <tr>
            <td>{{ $before_contact->temp }}</td>
        </tr>
        <tr>
            <th>朝食内容</th>
        </tr>
        <tr>
            <td>{{ $before_contact->breakfast }}</td>
        </tr>
        @if($before_contact->comment)
        <tr>
            <th>コメント</th>
        </tr>
        <tr>
            <td>{{ $before_contact->comment}}</td>
        </tr>
        @endif
    </table>
    @endforeach
@endif

    <div class='registerBox'>
        <a href="{{ route ('index')}}">マイページへ戻る</a>
    </div>
</div>
@endif



</body>
</html>