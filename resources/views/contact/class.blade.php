<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/nursery_register_style.css') }}">
    <title>保育園 連絡帳 クラス選択</title>
</head>
<body>

<div class='text'>
    <h1>{{ $nursery[0]->name }}</h1>
    <h2>連絡帳 クラス選択</h2>
    <p>連絡帳を確認するクラスを選択してください。</p>
</div>


<table class='all'>
    <tr>
        <th>クラス名　学年　担任</th>
    </tr>
    <form method="POST" action="{{ route('contact_student_select')}}">
    @csrf
    <tr>
        <td>
            <select class='class_id' name='class_id'>
                @foreach($classes as $class)
                <option class='class_id' value="{{ $class->id }}">{{ $class->name }}組　{{ $class->years }}歳児　{{ $class->teacher }}先生</option>
                @endforeach
            </select>
        </td>
    </tr>
</table>

<div class="registerBox">
    <button class="show" type="submit">クラスの生徒を見る</button>
    <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
</div>
</form>

</body>
</html>