<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function basicTest()
    {
        $response = $this->get('/');//引数のURIにアクセスし格納

        $response->assertStatus(200);//リクエスト結果のステータスを確認→http通信でのGETリクエストが問題なく行われているか
    }
}
