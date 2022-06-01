@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <x-ads/>
            </div>
            <div class="col-6">
                <div class="border p-5">
                    <h3>What's happening?</h3>
                    <form action="/p" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="row mb-3">
                                <label for="caption" class="col-md-6 col-form-label">What's on your mind?</label>

                                <input id="caption" type="text" class="form-control
                                       @error('caption') is-invalid @enderror" name="caption"
                                       value="{{ old('caption') }}" autocomplete="location"
                                       autocomplete="caption"
                                       autofocus>

                                @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mb-3">
                                <label for="post_img" class="col-md-6 col-form-label">Photo</label>

                                <input id="post_img" type="file" class="form-control
                                       @error('post_img') is-invalid @enderror" name="post_img"
                                       value="{{ old('post_img')}}" autocomplete="location"
                                       autocomplete="post_img"
                                       autofocus>

                                @error('post_img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <button class="btn btn-primary">Save Post</button>
                        </div>
                    </form>
                </div>
                @foreach($posts as $post)
                    <div class="nopadding w-100 border border-left border-right border-bottom border-top-0">
                        @if($post->retweet)
                            <div class="text-muted p-2">
                                @if($post->user->id == auth()->user()->id)
                                    You
                                @else
                                    <a href="/profile/{{$post->user->id}}" class="link-secondary text-decoration-none">
                                        &#64;{{$post->user->username}}
                                    </a>
                                @endif
                                retweeted
                            </div>
                        @endif
                        <div class="card-title">
                            <div class="flex-row d-flex align-items-center">
                                @if(!$post->retweet)
                                    <a href="/profile/{{$post->user->id}}" class="link-secondary text-decoration-none">
                                        <div class="flex-row d-flex align-items-center">
                                            <img src="{{$post->user->profile->profileImage()}}" id="profile_img"
                                                 class="rounded-circle p-2 m-2"
                                                 style="width: 70px; height: 70px;">
                                            <div class="flex-column d-flex">
                                                <div><b>{{$post->user->name}}</b></div>
                                                <div>&#64;{{$post->user->username}}</div>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <a href="/profile/{{$post->tweet_user_id}}"
                                       class="link-secondary text-decoration-none">
                                        <div class="flex-row d-flex align-items-center">
                                            <img
                                                src="{{\App\Models\User::find($post->tweet_user_id)->profile->profileImage()}}"
                                                id="profile_img"
                                                class="rounded-circle p-2 m-2"
                                                style="width: 70px; height: 70px;">
                                            <div class="flex-column d-flex">
                                                <div><b>{{\App\Models\User::find($post->tweet_user_id)->name}}</b></div>
                                                <div>
                                                    &#64;{{\App\Models\User::find($post->tweet_user_id)->username}}</div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span>{{$post->getPostedDate()}}</span>
                            </div>
                        </div>
                        <a href="/p/{{$post->id}}" class="link-secondary text-decoration-none">
                            <div class="card-img-bottom">
                                <p style="padding-left: 20px;">{{$post->caption}}</p>
                                @if($post->post_img)
                                    <img src="/storage/{{$post->post_img}}" class="w-100" style="height: auto;"/>
                                @endif
                            </div>
                        </a>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center p-1">
                                @if($post->retweet)
                                    <span class="d-flex flex-row align-items-center">
                                        <i class="material-icons">reply</i>
                                        <span>{{\App\Models\Post::find($post->tweet_id)->replied()->count()}}</span>
                                    </span>
                                    <span class="d-flex flex-row align-items-center">
                                    <retweet post-id="{{$post->id}}"
                                             tweet-count="{{\App\Models\Post::where('tweet_id', $post->tweet_id)->count()}}"
                                             retweeted="{{\App\Models\Post::where('tweet_id', $post->tweet_id)->get('user_id')->contains('user_id', auth()->user()->id)}}"></retweet>
                                    </span>
                                    <span class="d-flex flex-row">
                                        <reaction post-id="{{$post->id}}"
                                                  reaction-count="{{\App\Models\Post::find($post->id)->getReactionCount()}}"
                                                  color="{{\App\Models\Post::find($post->id)->loved->contains(auth()->user()->id)}}"></reaction>
                                    </span>
                                @else
                                    <span class="d-flex flex-row align-items-center">
                                        <i class="material-icons">reply</i>
                                        <span>{{$post->replied()->count()}}</span>
                                    </span>
                                    <span class="d-flex flex-row align-items-center">
                                    <retweet post-id="{{$post->id}}"
                                             tweet-count="{{\App\Models\Post::where('tweet_id', $post->id)->count()}}"
                                             retweeted="{{\App\Models\Post::where('tweet_id', $post->id)->get('user_id')->contains('user_id', auth()->user()->id)}}"></retweet>
                                    </span>
                                    <span class="d-flex flex-row">
                                        <reaction post-id="{{$post->id}}"
                                                  reaction-count="{{$post->getReactionCount()}}"
                                                  color="{{$post->loved->contains(auth()->user()->id)}}"></reaction>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex flex-row m-3">
                            <form action="/reply" method="post">
                                @csrf
                                <img src="{{$post->user->profile->profileImage()}}"
                                     id="profile_img"
                                     class="rounded-circle pr-1"
                                     style="border: 5px solid white; height: 50px; width: 50px;">
                                <span
                                    class="text-muted justify-content-end">Replying to &#64;{{$post->user->username}}</span><br>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                <textarea id="reply" class="form-control flex-fill
                                       @error('reply') is-invalid @enderror" name="reply" cols="80" rows="2"></textarea>

                                        @error('reply')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="submit" value="reply" class="btn btn-primary"/>
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-3">

                @if(empty($users->isEmpty()))
                    <x-who-to-follow :users="$users" :follow="$follow"/>
                @endif

            </div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 p-5 text-muted text-center">
                &bull;<br>
                Come back later for more
            </div>
            <div class="col-3"></div>
        </div>
    </div>
@endsection
