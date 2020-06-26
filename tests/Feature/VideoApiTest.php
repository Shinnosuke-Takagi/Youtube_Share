<?php

namespace Tests\Feature;

use App\User;
use App\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class VideoApiTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
      parent::setUp();

      $this->user = factory(User::class)->create();
  }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShould_save_video_id()
    {
        $data = [
          'video_id' => 'testtesttest'
        ];
        $response = $this->actingAs($this->user)
                         ->json('POST', route('share.video'),$data);

        $video = Video::first();
        $this->assertEquals($data['video_id'], $video->video_id);

        $response->assertStatus(201)
                 ->assertJson(['video_id' => $video->video_id]);
    }

    public function testShould_get_video_id()
    {
        factory(Video::class, 5)->create();

        $response = $this->json('GET', route('video.index'));

        $videos = Video::with(['recommender'])->get();

        $expected_data = $videos->map(function($video) {
            return [
              'video_id' => $video->video_id,
              'recommender' => [
                'name' => $video->recommender->name,
              ],
            ];
        })->all();

        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data')
                 ->assertJsonFragment([
                   "data" => $expected_data,
                 ]);
    }
}
