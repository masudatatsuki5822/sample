<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/letter_style.css') }}">
    <title>お便り編集</title>
</head>

<body>
<div class="letter_box">
    <h1>{{ $nursery[0]->name }} お便り編集</h1>

    <form action="{{ route('letter_update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="letter_box">

        <table class="contents">
            <input type="hidden" name="id" value="{{ $one_letter->id }}">
            <tr>
                <th>配信日</th>
            </tr>
            <tr>
                <td>{{ $one_letter->created_at->format('Y/m/d') }}</td>
            </tr>

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
                    <input name="title" class="title" value="{{ $one_letter->title }}">
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
                    <textarea name="body" placeholder="本文">{{nl2br($one_letter->body)}}</textarea>
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
            <button type="submit" class="add">お便りを編集する</button>
            <a href="{{ route ('index')}}">保育園マイページへ戻る</a>
        </div>
    </form>
</div>
</body>
</html>