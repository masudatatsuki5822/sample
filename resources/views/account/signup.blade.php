<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/login_style.css') }}">
</head>
<body>

<div class="text">
    <h1>保育園 新規登録画面</h1>
</div>


<div class='login_data'>
    <table>
        <form method="POST" action="{{ route('register')}}" onsubmit="return checkSubmit()">
            @csrf
            <tr>
                <th>保育園名:</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('name'))
                    <div class="text_danger">
                        {{$errors->first('name')}}
                    </div>
                    @endif
                    <input name="name" placeholder="保育園名">
                </td>
            </tr>
            <tr>
                <th>保育園 代表者名:</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('boss'))
                    <div class="text_danger">
                        {{$errors->first('boss')}}
                    </div>
                    @endif
                    <input name="boss" placeholder="保育園 代表者名">
                </td>
            </tr>
            <tr>
                <th>メールアドレス:</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('mail'))
                    <div class="text_danger">
                        {{$errors->first('mail')}}
                    </div>
                    @endif
                    <input name="mail" placeholder="メールアドレス">
                </td>
            </tr>
            <tr>
                <th>電話番号:</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('tel'))
                    <div class="text_danger">
                        {{$errors->first('tel')}}
                    </div>
                    @endif
                    <input name="tel" placeholder="電話番号">
                </td>
            </tr>
            <tr>
            <tr>
                <th>パスワード:</th>
            <tr>
                <td>
                    @if ($errors->has('password'))
                    <div class="text_danger">
                        {{$errors->first('password')}}
                    </div>
                    @endif
                    <input name="password" type="password" placeholder="パスワード">
                </td>
            </tr>
            <tr>
                <th>パスワード確認:</th>
            <tr>
                <td>
                    @if ($errors->has('password_confirmation'))
                    <div class="text_danger">
                        {{$errors->first('password_confirmation')}}
                    </div>
                    @endif
                    <input name="password_confirmation" type="password" placeholder="パスワード">
                </td>
            </tr>
            <input type="hidden" name="role" value="1">
            <input type="hidden" name="class_id" value="0">

            <div class="button_box">
                <button type="submit" class="register">登録</button>
                <button type="button" class="back" onclick="location.href='{{ route('login_show')}}'">ログイン画面に戻る</button>
            </div>
        </form>
    </table>
</div>

</body>
</html>
