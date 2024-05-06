<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/nursery_show_style.css') }}">
    <title>マイページ</title>
</head>
<body>

@can('nursery')
<h1>{{ $nursery[0]->name }} マイページ</h1>

<div class='mypage'>
    <div class='contents'>
        <div class='titleBox'>
            <h3>クラス管理</h3>
        </div>
        <div class='buttonBox'>
            <button  class="my_list" onclick="location.href='{{ route('class_show')}} '">クラスの一覧を見る</button>
            <button  class="my_add" onclick="location.href=' {{ route('class_add_show')}} '">クラスを登録する</button>
        </div>
    </div>
    <div class='contents'>
        <div class='titleBox'>
            <h3>生徒管理</h3>
        </div>
        <div class='buttonBox'>
            <button class="my_list" onclick="location.href=' {{ route('student_show')}} '">生徒一覧を見る</button>
            <button class="my_add" onclick="location.href=' {{ route('student_add_show')}} '">生徒の登録をする</button>
        </div>
    </div>
    <div class='contents'>
        <div class='titleBox'>
            <h3>お便り</h3>
        </div>
        <div class='buttonBox'>
            <button class="my_list" onclick="location.href=' {{ route('letter_show')}} '">お便り一覧を見る</button>
            <button class="my_add" onclick="location.href=' {{ route('letter_write_show')}} '">お便りの投稿をする</button>
        </div>
    </div>
    <div class='contents'>
        <div class='titleBox'>
            <h3>連絡帳</h3>
        </div>
        <div class='buttonBox'>
            <button class="my_list" onclick="location.href='{{ route('contact_classShow')}}'">連絡帳を確認する</button>
        </div>
    </div>
</div>

<div class="logout">
    <form method ="POST" action="{{ route('logout') }}">
        @csrf
        <button class='logout'>ログアウト</button>
    </form>
</div>


@elseif('student')
<h1>生徒 マイページ</h1>

<div class='mypage'>
    <div class='contents'>
        <div class='titleBox'>
            <h3>お便り</h3>
        </div>
        <div class='buttonBox'>
            <button class="my_list" onclick="location.href=' {{ route('letter_show')}} '">お便り一覧を見る</button>
        </div>
    </div>

    <div class='contents'>
        <div class='titleBox'>
            <h3>連絡帳</h3>
        </div>
        <div class='buttonBox'>
            <button class="my_list" onclick="location.href=''">連絡帳を読む</button>
            <button class="my_add" onclick="location.href='{{ route('contact_write')}}'">連絡帳を記入する</button>
        </div>
    </div>
</div>

<div class="logout">
    <form method ="POST" action="{{ route('logout') }}">
        @csrf
        <button class='logout'>ログアウト</button>
    </form>
</div>
@endif

</body>
</html>