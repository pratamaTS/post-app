<?php

namespace App\Http\Controllers;

use App\Http\Repository\MethodRepository;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    protected $methodRepository;

    public function __construct()
    {
        $this->methodRepository = new MethodRepository;
    }

    public function index()
    {
        $posts = $this->methodRepository->getData(new Post());

        return $posts;
    }

    public function detail(Post $post)
    {
        $posts = $this->methodRepository->getDataDetail($post, $post->id);

        return $posts;
    }

    public function store()
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'max:50'], 
            'content' => ['required', 'string']
        ]);

        $data['published_at'] = Carbon::now();

        $callback = $this->methodRepository->storeOrUpdate(new Post(), $data);
        
        return $callback;
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'max:50'], 
            'content' => ['required', 'string']
        ]);

        $data['published_at'] = Carbon::now();

        $callback = $this->methodRepository->storeOrUpdate($post, $data);
        
        return $callback;
    }

    public function delete(Post $post)
    {
        $this->methodRepository->delete($post);
        return 'Delete success!';
    }
}
