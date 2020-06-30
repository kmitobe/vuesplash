<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePhoto;
use App\Photo;
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
        // 投稿写真の拡張子を取得する
        $extension = $request->photo->extension();

        $photo = new Photo();

        // インスタンス生成時にランダムに割り振られたID値と
        // 本来の拡張子を組み合わせてファイル名とする
        $photo->filename = $photo->id . "." . $extension;


        // ファイルを保存する
        // $request->file('file')->store('');

        // データベースエラー時にファイル削除を行う為
        // トランザクションを利用する
        // DB::beginTransaction();

        // コミット
        // try{
        //     Auth::user()->photos()->save($photo);
        //     DB::commit();
        // }catch(\Exception $exception){
        //     DB::rollBack();
        //     // DBとの不整合を避ける為アップロードしたファイルを削除
        //     Storage::cloud()->delete($photo->filrname);
        //     throw $exception;
        // }


        // リソースの新規作成なので
        // レスポンスコードは201を返却する
        return response($photo,201);
    }
}