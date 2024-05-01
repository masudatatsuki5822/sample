<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/nursery_style.css') }}">
    <title>保育園 クラス登録</title>
</head>
<body>
<h1>保育園 クラス登録</h1>


登録するクラスの詳細をご記入ください。
<div class='container'>
    <table>
        <form method="POST" action="{{ route('class_add') }}">
        @csrf
            <tr>
                <th>クラス名：</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('classname'))
                    <div class="text_danger">
                        {{$errors->first('classname')}}
                    </div>
                    @endif
                    <input name="classname" placeholder="クラス名">
                </td>
            </tr>
            <tr>
                <th>学年：</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('years'))
                        <div class="text_danger">
                            {{$errors->first('years')}}
                        </div>
                    @endif
                    <select name="years" placeholder="学年">
                        @for ($i = 0; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}歳児</option>
                        @endfor
                    </select>
                </td>
            </tr>
            <tr>
                <th>担任の先生：</th>
            </tr>
            <tr>
                <td>
                @if ($errors->has('teacher'))
                    <div class="text_danger">
                        {{$errors->first('teacher')}}
                    </div>
                    @endif
                    <input name="teacher" placeholder="担任の先生">先生
                </td>
            </tr>

            <div class='registerBox'>
                <button class="add" type="submit">クラスの登録をする</button>
                <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
            </div>
        </form>
    </table>
</div>

</body>
</html>