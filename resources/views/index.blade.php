<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Covert</title>
</head>
<body>
    <header></header>
    <main>
        <div class="encode">
            <h1>ファイル → Base64 へエンコード</h1>
            @error('file')
                {{ $message }}
            @enderror
            @if ( empty($viewData['encodedBase64Str']) )
                <form action="{{ route('encode') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" id="input-file">
                    <input type="submit" value="変換">
                </form>
            @else
                <textarea name="" id="" cols="180" rows="10">{{ $viewData['encodedBase64Str'] }}</textarea>
            @endif
        </div>
        <div class="decode">
            <h1>Base64 → ファイル デコード</h1>
            @error('decodeBase64Str')
                {{ $message }}
            @enderror
            @if ( empty($viewData['decodeBase64Str']) )
                <form action="{{ route('decode') }}" method="post">
                    @csrf
                    <input type="text" name="decodeBase64Str" id="input-base64_str">
                    <input type="submit" value="変換">
                </form>
            @else
                <img src="data: {{ $viewData['mime'] }};base64, {{ $viewData['decodeBase64Str'] }}">
            @endif
        </div>
        <div class="clear">
            <a href="{{ route('index') }}">
                <button>内容クリア</button>
            </a>
        </div>
    </main>
    <footer></footer>
</body>
</html>