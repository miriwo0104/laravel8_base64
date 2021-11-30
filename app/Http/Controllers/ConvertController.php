<?php

namespace App\Http\Controllers;

use App\Http\Requests\EncodeRequest;
use App\Http\Requests\DecodeRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ConvertController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function encode(EncodeRequest $request)
    {
        $postData = $request->validated();
        // ファイルを文字列とする
        $file = file_get_contents($postData['file']);
        // ファイルをbase64でエンコード
        $encodedBase64Str = base64_encode($file);
        // view表示用データの整形
        $viewData = [
            'encodedBase64Str' => $encodedBase64Str,
        ];

        return view('index', ['viewData' => $viewData]);
    }

    public function decode(DecodeRequest $request)
    {
        $postData = $request->validated();

        // base64文字列のData-URL宣言の削除
        $base64Str = str_replace(' ', '+', preg_replace('/^data:image.*base64,/', '', $postData['decodeBase64Str']));
        // ファイルのデコード
        $decodeFile = base64_decode($base64Str);
        // mimeの取得
        $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $decodeFile);

        // view表示用データの整形
        $viewData = [
            'decodeBase64Str' => $base64Str,
            'mime' => $mime,
        ];

        return view('index', ['viewData' => $viewData]);
    }
}
