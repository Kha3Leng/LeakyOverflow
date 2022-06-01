<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('viewAny', Post::class);
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();
        $following = auth()->user()->following->pluck('user_id')->toArray();
        array_push($following, auth()->user()->id);
        $users = \App\Models\User::whereNotIn('id', $following)->get();
        $follow = false;
        return view('posts.index', compact('posts', 'users', 'follow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        // this current user is authorized to create posts accorting to PostPolicy
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required',
            'post_img' => ['image', 'max:5000', 'mimes:jpg,jpeg,png'],
        ]);

        $post_img_path = '';
        if ($request['post_img']) {
            $post_img_path = $request['post_img']->store('post', 'public');
            $post_img = Image::make(public_path("storage/$post_img_path"))->fit(1200, 1200);
            $post_img->save();
        }

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'post_img' => $post_img_path,
            'retweet' => false,
            'tweet_user_id' => null,
            'tweet_id' => null
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function retweet(Post $post)
    {
        $retweet_count = 0;
        $retweeted = false;

        if($post->retweet){
            $tweet_id = $post->tweet_id;
            $already_retweet = Post::where('user_id', auth()->user()->id)
                ->where('tweet_id', $post->tweet_id)
                ->where('retweet', true)
                ->count();
            $retweet_count =\App\Models\Post::where('tweet_id', $post->tweet_id)->count();
            $retweeted = \App\Models\Post::where('tweet_id', $post->tweet_id)->get('user_id')->contains('user_id', auth()->user()->id);
        }else{
            $tweet_id = $post->id;
            $already_retweet = Post::where('user_id', auth()->user()->id)
                ->where('tweet_id', $post->id)
                ->where('retweet', true)
                ->count();
            $retweet_count = \App\Models\Post::where('tweet_id', $post->id)->count();
            $retweeted = \App\Models\Post::where('tweet_id', $post->id)->get('user_id')->contains('user_id', auth()->user()->id);
        }
        if($already_retweet > 0 ){
            // undo retweet
            // delete retweeted post
//            $post->delete();

        }else{
            auth()->user()->posts()->create([
                'caption' => $post->caption,
                'post_img' => $post->post_img,
                'retweet' => true,
                'tweet_user_id' => $post->user->id,
                'tweet_id' => $tweet_id
            ]);
        }
        $retweeted = $retweeted? $retweeted: 0;

        return [$retweet_count, $retweeted];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
//        $this->authorize('view', Post::class);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/profile/' . auth()->user()->id);
    }
}
