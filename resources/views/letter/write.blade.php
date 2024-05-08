<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/letter_style.css') }}">
    <title>保育園 お便り投稿</title>
</head>

<body>

<div class="text">
    <h1>{{ $nursery[0]->name }}</h1>
    <h2>お便り投稿</h2>
</div>
<div class="letter_box">
    <form action="{{ route('letter_write') }}" method="POST" enctype="multipart/form-data" onsubmit="return subForm()">
    @csrf
        <table class="contents">
            <tr>
                <th>送信先クラス</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('class_id'))
                    <div class="text_danger">
                        {{$errors->first('class_id')}}
                    </div>
                    @endif

                    @foreach($classes as $class)
                    <input type="checkbox" name="class_id[]" value="{{ $class->id }}" class="class_id">{{ $class->name }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>タイトル</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('title'))
                    <div class="text_danger">
                        {{$errors->first('title')}}
                    </div>
                    @endif
                    <input name="title" class="title" placeholder="タイトル">
                </td>
            </tr>

            <tr>
                <th>本文</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('body'))
                    <div class="text_danger">
                        {{$errors->first('body')}}
                    </div>
                    @endif
                    <textarea name="body" placeholder="本文">{!! nl2br(e(old('body'))) !!}</textarea>
                </td>
            </tr>
            <tr>
                <th>画像</th>
            </tr>
            <tr>
                <td>
                    @if ($errors->has('image'))
                    <div class="text_danger">
                        {{$errors->first('image')}}
                    </div>
                    @endif
                    <input type="file" name="image" class="title">
                </td>
            </tr>
        </table>

        <div class='registerBox'>
            <button type="submit" class="add">お便りを投稿する</button>
            <a href="{{ route ('index')}}">マイページへ戻る</a>
        </div>
    </form>
</div>
</body>
</html>