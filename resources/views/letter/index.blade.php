<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/letter_style.css') }}">
    <title>お便り一覧</title>
</head>
<body>

@can('nursery')
<div class="text">
    <h1>{{ $nursery[0]->name }}</h1>
    <h2>お便り一覧</h2>
    @if(session('success'))
    <div class="alert">
        <p class="session">{{ session('success') }}</p>
    </div>
    @endif
</div>


<div class="letter_box">
    <table class='all'>
        <tr>
            <th>配信日</th>
            <th>タイトル</th>
            <th>送信クラス</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        @foreach($allLetters as $allLetter)
        <tr>
            <td>{{ $allLetter->created_at->format('Y/m/d') }}</td>
            <td>{{ $allLetter->title }}</td>
            <td>{{ $allLetter->names }}</td>
            <td><button class="detail" onclick="location.href='/letter/all/{{ $allLetter->id }}'">詳細を見る</button></td>
            <td><button class="edit"onclick="location.href='/letter/edit/{{ $allLetter->id }}'">編集する</button></td>
            <td><form method="POST" action="{{ route('letter_delete', $allLetter->id) }}"onsubmit="return checkDelete()">
            @csrf
            <button class='delete' type="submit">削除する</button>
            </form></td>
        </tr>
        @endforeach
    </table>

    <div class="registerBox">
        <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
    </div>
</div>

@elseif('student')
<div class="text">
    <h1>生徒 お便り一覧</h1>
    <h2>{{ $studentName[0]->name }}さん</h2>
</div>
<div class="letter_box">
    <table class='all'>
        <tr>
            <th>配信日</th>
            <th>タイトル</th>
            <th>送信クラス</th>
            <th></th>
        </tr>

        @foreach($allLetters as $allLetter)
        <tr>
            <td>{{ $allLetter->created_at->format('Y/m/d') }}</td>
            <td>{{ $allLetter->title }}</td>
            <td>{{ $allLetter->names }}</td>
            <td><button class="detail" onclick="location.href='/letter/all/{{ $allLetter->id }}'">詳細を見る</button></td>
        </tr>
        @endforeach
    </table>

    <div class="registerBox">
        <a href="{{ route ('index')}}">生徒マイページへ戻る</a>
    </div>
</div>
@endif

<script src="{{ asset('/js/delete.js') }}"></script>
</body>
</html>