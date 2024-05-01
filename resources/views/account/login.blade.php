<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login_style.css') }}">
    <title>はぐみー</title>
</head>

<body>

<div class='container'>
    <div class="logo_box">
        <img src="{{ asset('image/hugme.png') }}" alt="logo">
    </div>

    <div class='login_data'>
        <table>
            <form method="POST" action="{{ route('login') }}">
                @csrf
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
                    <th>パスワード:</th>
                </tr>
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
                <div class="button_box">
                    <button type="submit" class="login">ログイン</button>
                    <a href="{{ route('signup')}}">新規登録はこちら</a>
                </div>
            </form>
        </table>
                
    </div>
</div>

</body>
</html>
