<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/nursery_register_style.css') }}">
    <title>保育園 連絡帳 クラス選択</title>
</head>
<body>
<h1>{{ $nursery[0]->name }} 連絡帳 クラス選択</h1>

<div class='text'>
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
            <select name='class_id'>
                @foreach($classes as $class)
                <option value="{{ $class->id }}" id="class_id">{{ $class->name }}組　{{ $class->years }}歳児　{{ $class->teacher }}先生</option>
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