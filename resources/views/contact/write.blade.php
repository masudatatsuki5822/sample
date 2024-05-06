<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/letter_style.css') }}">
    <title>生徒 連絡帳投稿</title>
</head>

<body>
<div class="letter_box">
    <h1>{{ $nursery[0]->name }}生徒 連絡帳投稿</h1>

    <form action="{{ route('contact_send') }}" method="POST" enctype="multipart/form-data" onsubmit="return subForm()">
    @csrf
        <table class="contents">

            <tr>
                <th>今日の日付</th>
            </tr>
            <tr>
                <td><input type="hidden" name="today" value="{{$carbon->format('Y/m/d')}}">{{ $carbon->format('Y/m/d') }}</td>
            </tr>
            <tr>
                <th>お迎え時刻</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('back_time'))
                    <div class="text_danger">
                        {{$errors->first('back_time')}}
                    </div>
                    @endif
                    <label for="date" class="col-form-label">時刻を入力</label>
                    <input type="time" class="form-control" name="back_time">

                </td>
            </tr>
            <tr>
                <th>体温</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('temp'))
                    <div class="text_danger">
                        {{$errors->first('temp')}}
                    </div>
                    @endif

                    <select name="temp" class="title">
                        <option hidden value="">選択してください</option>
                    @for ($temp = 35.0; $temp <= 39.0; $temp += 0.1)
                        <option value="{{ $temp }}">{{ number_format($temp, 1) }}</option>
                    @endfor
                    </select>
                </td>
            </tr>

            <tr>
                <th>朝食内容</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('breakfast'))
                    <div class="text_danger">
                        {{$errors->first('breakfast')}}
                    </div>
                    @endif
                    <input name="breakfast" class="title" placeholder="朝食内容">
                </td>
            </tr>
            <tr>
                <th>コメント</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('comment'))
                    <div class="text_danger">
                        {{$errors->first('comment')}}
                    </div>
                    @endif
                    <textarea name="comment" placeholder="コメント">{!! nl2br(e(old('comment'))) !!}</textarea>
                </td>
            </tr>
        </table>

        <div class='registerBox'>
            <button type="submit" class="add">連絡帳を送信する</button>
            <a href="{{ route ('index')}}">マイページへ戻る</a>
        </div>
    </form>
</div>
</body>
</html>