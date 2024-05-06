<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/nursery_register_style.css') }}">
    <title>保育園 生徒登録</title>
</head>
<body>
<h1>{{ $nursery[0]->name }} 生徒登録</h1>

<p1>登録する生徒の詳細をご記入ください。</p1>
<div class='container'>
    <table>
        <form method="POST" action="{{ route('student_add') }}">
        @csrf
            <tr>
                <th>生徒名：</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('studentname'))
                    <div class="text_danger">
                        {{$errors->first('studentname')}}
                    </div>
                    @endif
                    <input name="studentname" placeholder="生徒名">
                </td>
            </tr>
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
                    <select name="class_id">
                        @foreach($classes as $class)
                        <option value="{{ $class->id }}" id="class_id">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>メールアドレス：</th>
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
            <tr>
                <th>電話番号：</th>
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
                <th>パスワード：</th>
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

            <input type="hidden" name="role" value="2">

            <div class="registerBox">
                <button type="submit" class="add">生徒登録</button>
                <button type="button" class="list" onclick="location.href='{{ route('student_show')}}'">生徒一覧を見る</button>
            </div>
            
        </form> 
        
    </table>
    
</div>



</body>
</html>