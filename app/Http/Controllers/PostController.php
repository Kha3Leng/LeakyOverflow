<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __constructor(){
        $this->middleware('auth');
    }
    public function index()
    {
//        $this->authorize('view', Post::class);
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();
//        dd($posts);
        $love = 'yes';
        return view('posts.index', compact('posts'));
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
            'post_img' => ['required', 'image']
        ]);

        $post_img_path = $request['post_img']->store('post', 'public');
        $post_img = Image::make(public_path("storage/$post_img_path"))->fit(1200, 1200);
        $post_img->save();

        auth()->user()->posts()->create([
            'caption' =>$data['caption'],
            'post_img' => $post_img_path
        ]);

        return redirect('/profile/'.auth()->user()->id);
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
        //
    }
}
