<?php

namespace Tests\Feature;

use App\Photo;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class PhotoSubmitApiTest extends TestCase
{
    use RefreshDatabases;
    // 事前処理(フィクスチャ)
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }
    /**
     *  @test
     */
    public function shold_ファイルをアップロードできる()
    {
        // S3 ではないストレージを使用する
        // storege/framework/testing
        Storage::fake("s3");

        // 画像を作成してAPIに送信するテスト
        $response = $this->actingAs($this->user)
            ->json("POST",route("photo.create"),[
                
            // ダミーファイルを作成して送信している
            "photo" => UploadedFile::fake()->image("photo.jpg"),
        ]);

        // レスポンスが201(created)である事のテスト
        $response->assertStatus(201);

        $photo = photo::first();

        // 写真IDがランダムな文字列である事
        $this->assertRegExp("/^[0-9a-zA-Z-_]{12}$/",$photo->id);

        // DBに挿入されたファイル名のファイルがストレージに保存されている事
        Storage::cloud()->assertExists($photo->filename);
    }

    /**
     *  @test
     */
    public function should_データベースエラーの場合はファイルを保存しない()
    {
        // テーブルをdropすることによってテーブルエラーを起こし、テストの確認を行う
        Schema::drop("photos");
        Storage::fake("s3");

        $response = $this->actingAs($this->user)
            ->json("POST",route("photo.create"),[
            // ダミーファイルを作成して送信する
            "photo" => UploadedFile::fake()->image("photo.jpg"),
        ]);

        // レスポンスが500（INTERNAL　SERVER ERROR）であること
        $response->assertStatus(500);

        // ストレージにファイルが保存されていないこと
        $this->assertEquals(0, count(Storage::cloud()->files()));
        
    }

    public function should_ファイル保存エラーの場合はDBへの保存はしない()
    {
        // ストレージをモックして保存時にエラーを起こさせる
        Storage::shouldReceive("cloud")
            ->once()
            ->andReturnNull();
        
        $response = $this->actingAs($this->user)
            ->json("POST",route("photo.create"),[
            "photo" => UploadedFile::fake()->image("photo.jpg"),
        ]);

        // レスポンスが500(INTERNAL　SERVER　ERROR)であること
        $response->assertStatus(500);
        $this->assertEmpty(Photo::all());
    }
}
