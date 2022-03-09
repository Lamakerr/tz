<?php

namespace App\Http\Controllers;

use App\Filters\PostFilter;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\Hashtag;
use App\Models\HashtagPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(PostFilter $request)
    {

        $users = User::all();
        $posts = Post::filter($request)->get();
        $post = Post::filter($request)->with('hashtags')->get();
        $hashtags = Hashtag::all();

        return view('posts.index', compact('users', 'posts', 'post', 'hashtags'));
    }

    public function create()

    {
        // $user = User::where('id', 1)->first();

        return  view('posts.create');
    }

    public function store(StorePostRequest $request)

    {   

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = 5;
        $post->save();

        $hashtags = $request->hashtags;
        $hashtags = trim($hashtags);
        $hashtags = explode(',', $hashtags);
        $hashtags = array_diff(array_map('trim', $hashtags), array(''));

        $lastPost= Post::latest('id')->first();
 

        $countTags = count($hashtags);

        $tagsId = collect(DB::table('hashtags')->orderBy('id','desc')->take($countTags)->select('id')->get())->reverse();
        


        foreach ($hashtags as $name) {

            Hashtag::insertOrIgnore(['name' => $name, 'created_at' => now(), 'updated_at' => now()]);  
        }
       
        foreach ($tagsId as $tagId) {
            

            HashtagPost::insertOrIgnore(['post_id' => $lastPost->id, 'hashtag_id' => $tagId->id, 'created_at' => now(), 'updated_at' => now()]);  
        }


        return 'Пост создан';
    }

    public function show($id)

    {
        $user = auth()->user();
        $post = Post::find($id);
        return json_decode($post, $user);
    }


    public function edit($id)

    {
        $CurrentUserId = auth()->id;
        $post = Post::find($id);
        if ($post->user_id !== $CurrentUserId) {
            return "Вы не создавали этот пост!";
        }
        $user = auth()->user();
        $post = Post::find($id);
        return  "Страница редактирования поста";
    }

    public function update(UpdatePostRequest $request, $id)

    {
        $post = Post::where('id', $id)->first();
        $post->update(
            ['title' => $request->title, 'content' => $request->content]
        );

        return "Cтатья изменена!";
    }

    public function delete($id)

    {
        $CurrentUserId = auth()->id;
        $post = Post::find($id);
        if ($post->user_id !== $CurrentUserId) {
            return "Вы не создавали этот пост!";
        }
        $post->delete();
        return 'Пост удален';
    }
}
