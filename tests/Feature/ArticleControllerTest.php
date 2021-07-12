<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(400);
    }

    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        // 200であれば合格 
        $response->assertStatus(200)->assertViewIs('articles.index');
    }

    public function testGuestCreate()
    {
        // 指定したルートのレスポンスを返す
        $response = $this->get(route('articles.create'));

        // リダイレクト先がログイン画面ならOK
        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
        // ファクトリーでユーザー作成(準備)
        $user = factory(User::class)->create();

        // 作ったユーザーでログインして記事作成する（実行）
        $response = $this->actingAs($user)->get(route('articles.create'));

        // ステータスがOKなら、viewの画面を確認する（レスポンスを検証）
        $response->assertStatus(200)->assertViewIs('articles.create');
    }
}
