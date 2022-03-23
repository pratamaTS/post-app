<?php

namespace Tests\Feature;

use App\Models\Post;
use Carbon\Carbon;
use Database\Factories\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function it_can_get_post_data()
    {
        PostFactory::new()->count(10)->create();

        $callback = $this->get(route('post.index'))
            ->assertJson(fn(AssertableJson $json) => [
                $json->has('0.id')
                    ->has('0.title')
                    ->has('0.content')
                    ->has('0.published_at')
                    ->has('0.created_at')
                    ->has('0.updated_at')
                    ->etc()
            ]);

        $callback->assertStatus(200);
    }

    /** @test */
    public function it_can_get_post_detail_data()
    {
        $post = PostFactory::new()->create();
        
        $callback = $this->get(route('post.detail',[$post->id]))
            ->assertJson(fn(AssertableJson $json) => [
                $json->has('id')
                    ->has('title')
                    ->has('content')
                    ->has('published_at')
                    ->has('created_at')
                    ->has('updated_at')
                    ->etc()
            ]);

        $callback->assertStatus(200);
    }

    /** @test */
    public function it_can_store_post_data()
    {
        $data = [
            'title' => 'test1',
            'content' => 'dang ding dong',
            'published_at' => Carbon::now()
        ]; 

        $callback = $this->post(route('post.store'), $data);

        $this->assertEquals($data['title'], $callback['title']);
        $this->assertEquals($data['content'], $callback['content']);
        $this->assertEquals($data['published_at'], $callback['published_at']);

        $callback->assertStatus(201);
    }

    /** @test */
    public function it_can_update_post_data()
    {
        $post = PostFactory::new()->create();

        $data = [
            'title' => 'test1edit',
            'content' => 'dang ding dong dedeng',
            'published_at' => Carbon::now()
        ]; 

        $callback = $this->put(route('post.update',$post->id), $data);

        $this->assertEquals($data['title'], $callback['title']);
        $this->assertEquals($data['content'], $callback['content']);
        $this->assertEquals($data['published_at'], $callback['published_at']);

        $callback->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_post_data()
    {
        $post = PostFactory::new()->create();

        $callback = $this->delete(route('post.delete',$post->id));

        $count = Post::firstWhere('id', $post->id);

        $callback->assertStatus(200);
        $this->assertEquals(null, $count);
    }
}
