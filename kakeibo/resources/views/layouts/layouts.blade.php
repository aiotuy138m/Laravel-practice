<html>
    <head>
        <title>家計簿</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!--BootStrapを読み込んでる部分-->
    </head>
    <body>
        <div class="container">
            @yield('content') <!--レイアウトファイル以外のファイルを読み込む-->
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script> <!--BootStrapを読み込んでる部分-->
    </body>
</html>