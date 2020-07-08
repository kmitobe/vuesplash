<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePhoto;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PhotoController extends Controller
{
    //認証が必要
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * 写真投稿
     * @param StorePhoto $request
     * @return \Illuminate\Http\Response
     */
    public function create(StorePhoto $request)
    {
        echo "create!!";
        // // 投稿写真の拡張子を取得する
        // $extension = $request->photo->extension();

        // $photo = new Photo();
        // // インスタンス生成時にランダムに割り振られたID値と
        // // 本来の拡張子を組み合わせてファイル名とする
        // $photo->filename = $photo->id . "." . $extension;

        // request()->file->storeAs('public', $file_name);

        // $image = new Image();
        // $image->path = 'storage/' . $file_name;
        // $image->title = $request->title;
        // $image->save();

        // return ['success' => '登録しました!'];

        // // リソースの新規作成なので
        // // レスポンスコードは201を返却する
        // return response($photo,201);
    }
}