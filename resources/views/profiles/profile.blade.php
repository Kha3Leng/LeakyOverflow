@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <x-alert/>
            </div>
            <div class="col-6 nopadding">
                <div class="flex-column">
                    <img src="{{$profile->headerImage()}}" id="bg_img" class="w-100" style="height: 230px;"/>
                    <div class="d-flex align-items-center justify-content-between">
                        <img src="{{$profile->profileImage()}}" id="profile_img" class="rounded-circle w-25 h-25"
                             style="margin-left:10px; margin-top: -80px; border: 5px solid white;">
                        @can('update', $user->profile)
                            <a href="/profile/{{$user->id}}/edit"
                               class="align-content-end text-decoration-none rounded-pill p-2"
                               style="border: 1px solid grey; padding: 10px;">Edit Profile</a>
                        @endcan
                        @cannot('update', $user->profile)
                            <div class="d-flex align-items-center justify-content-end">
                                <a href="/profile/{{$user->id}}/edit"
                                   class="rounded-pill m-2"
                                   style="border: 1px solid grey; padding: 10px; padding-bottom: 5px;"><i
                                        class="material-icons">reply</i></a>

                                <a href="/m/{{$user->id}}/messages"
                                   class="align-content-end m-2 text-decoration-none rounded-pill"
                                   style="border: 1px solid grey;  padding: 10px; padding-bottom: 5px;"><i
                                        class="material-icons">send</i></a>

                                <div class="m-2 align-content-end text-decoration-none rounded-pill p-2"
                                     style="border: 1px solid grey; padding: 10px;">
                                    <follow-button user-id="{{$user->id}}" follow="{{$follow}}"></follow-button>
                                </div>
                            </div>
                        @endcannot
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 nopadding pt-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span style="font-size: 20px;"><strong>{{$user->name}}</strong></span><br>
                        <span>&#64;{{$user->username}}</span>
                    </div>
                    @can('update', $user->profile)
                        <a href="/p/create" class="align-content-end text-decoration-none rounded-pill p-2"
                           style="border: 1px solid grey; padding: 10px;">Tweet</a>
                    @endcan
                </div>

                <div class="pt-3">
                    <strong>{{$user->profile->bio}}</strong>
                </div>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 nopadding d-flex pt-3">
                @if($user->profile->website)
                    <div class="pl-2 float-left  align-items-center "><i
                            class="material-icons">link</i> {{$user->profile->website}}</div>
                @endif
                @if($user->profile->location)
                    <div class="pl-2 float-left  align-items-center "><i
                            class="material-icons">home</i> {{$user->profile->location}}</div>
                @endif
                @if($born_on)
                    <div class="pl-2 float-left  align-items-center "><i class="material-icons">cake</i> {{$born_on}}
                    </div>
                @endif
                @if($joined_date)
                    <div class="pl-2 float-left  align-items-center "><i
                            class="material-icons">today</i> {{$joined_date}}
                    </div>
                @endif
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 text-left pt-2 pb-2">
                <a href="/following/{{$user->id}}" class="text-decoration-none link-secondary">
                    <span><strong class="font-weight-bolder">{{$followingCount}}</strong> Following</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                <a href="/follower/{{$user->id}}" class="text-decoration-none link-secondary">
                    <span><strong class="font-weight-bolder">{{$followerCount}}</strong> Followers</span>
                </a>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 nopadding">
                <hr>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row nopadding">
            <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
            <div class="col-3"></div>
            <div class="col-6">
                <ul class="nav nav-tabs nav-fill w-100" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tweet-tab" data-bs-toggle="tab"
                                data-bs-target="#tweet"
                                type="button" role="tab" aria-controls="tweet" aria-selected="true">
                            {{$user->posts()->count()}} Tweets
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="replies-tab" data-bs-toggle="tab" data-bs-target="#replies"
                                type="button" role="tab" aria-controls="replies" aria-selected="false">
                            {{$user->postsWithReply()->count()}} Tweets with
                            replies
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="following-tab" data-bs-toggle="tab" data-bs-target="#following"
                                type="button" role="tab" aria-controls="following" aria-selected="false">Following
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="likes-tab" data-bs-toggle="tab" data-bs-target="#likes"
                                type="button" role="tab" aria-controls="likes" aria-selected="false">
                            {{$user->loving()->count()}} Likes
                        </button>
                    </li>
                </ul>
                <div class="tab-content"
                     id="myTabContent">
                    <div class="tab-pane fade show active" id="tweet" role="tabpanel" aria-labelledby="tweet-tab">
                        @foreach($user->posts as $post)

                            <div class="nopadding border border-right border-left border-top-0 border-bottom">
                                @if($post->retweet)
                                    <div class="text-muted p-2">
                                        @if($post->user->id == auth()->user()->id)
                                            You
                                        @else
                                            <a href="/profile/{{$post->user->id}}"
                                               class="link-secondary text-decoration-none">
                                                &#64;{{$post->user->username}}
                                            </a>
                                        @endif
                                        retweeted
                                    </div>
                                @endif
                                <div class="card-title">
                                    <div class="flex-row d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-start align-items-center">
                                            @if(!$post->retweet)
                                                <div class="flex-row d-flex align-items-center">
                                                    <img src="{{$post->user->profile->profileImage()}}" id="profile_img"
                                                         class="rounded-circle p-2 m-2"
                                                         style="width: 70px; height: 70px;">
                                                    <div class="flex-column d-flex">
                                                        <div><b>{{$user->name}}</b></div>
                                                        <div>&#64;{{$user->username}}</div>
                                                    </div>
                                                </div>
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
                                                            <div>
                                                                <b>{{\App\Models\User::find($post->tweet_user_id)->name}}</b>
                                                            </div>
                                                            <div>
                                                                &#64;{{\App\Models\User::find($post->tweet_user_id)->username}}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                                            <span>{{$post->getPostedDate()}}</span></div>
                                        @can('delete', $post)
                                            <div class="p-3">
                                <span>
                                        <a href="/d/{{$post->id}}" class="link-secondary text-decoration-none">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </span>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                                <a href="/p/{{$post->id}}" class="link-secondary text-decoration-none">
                                    <div class="card-img-bottom">
                                        <p style="padding-left: 20px;">{{$post->caption}}</p>
                                        @if($post->post_img)
                                            <img src="/storage/{{$post->post_img}}" class="w-100"
                                                 style="height: auto;"/>
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
                                                             reaction-count="{{\App\Models\Post::where('tweet_id', $post->tweet_id)->count()}}"
                                                             color="{{$post->loved->contains(auth()->user()->id)}}"></retweet>
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
                                                             reaction-count="{{\App\Models\Post::where('tweet_id', $post->id)->count()}}"
                                                             color="{{\App\Models\Post::where('tweet_id', $post->id)->get('user_id')->contains(auth()->user()->id)}}"></retweet>
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
                                        <img src="{{auth()->user()->profile->profileImage()}}"
                                             id="profile_img"
                                             class="rounded-circle pr-1"
                                             style="border: 5px solid white; height: 50px; width: 50px;">
                                        <span
                                            class="text-muted justify-content-end">Replying to &#64;{{$user->username}}</span><br>
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
                    <div class="tab-pane fade" id="replies" role="tabpanel" aria-labelledby="replies-tab">
                        <div class="row">
                            @foreach($user->postsWithReply() as $post)
                                <div class="col-6 nopadding">
                                    <div class="m-1 border">
                                        <div>
                                            <div class="flex-row d-flex align-items-center">
                                                <img src="{{$post->user->profile->profileImage()}}" id="profile_img"
                                                     class="rounded-circle p-2 m-2"
                                                     style="width: 70px; height: 70px;">
                                                <div class="flex-column d-flex">
                                                    <div><b><a href="/profile/{{$post->user->id}}"
                                                               class="text-decoration-none">{{$post->user->name}}</a></b>
                                                    </div>
                                                    <div>&#64;{{$post->user->username}}</div>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span>{{$post->getPostedDate()}}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p style="padding-left: 20px;">{{$post->caption}}</p>
                                            @if($post->post_img)
                                                <img src="/storage/{{$post->post_img}}" class="w-100"
                                                     style="height: auto;"/>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center p-1">
                                    <span class="d-flex flex-row align-items-center">
                                        <i class="material-icons">reply</i>
                                        <span>{{$post->replied()->count()}}</span>
                                    </span>
                                                <span class="d-flex flex-row">
                                        <reaction post-id="{{$post->id}}"
                                                  reaction-count="{{$post->getReactionCount()}}"
                                                  color="{{$post->loved->contains(auth()->user()->id)}}"></reaction>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    @foreach($post->ownReply($user) as $reply)
                                        <div>
                                            <span class="text-muted">&#64;{{$user->username}}</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span>{{$reply->created_at}}</span>
                                            <br>
                                            <span
                                                class="text-muted justify-content-end">Replying to &#64;{{$post->user->username}}</span><br>
                                            <span>{{$reply->message}}</span>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="likes" role="tabpanel" aria-labelledby="likes-tab">
                        @foreach($user->loving as $post)

                            <div class="nopadding border border-right border-left border-top-0 border-bottom">

                                <div class="card-title">
                                    <div class="flex-row d-flex justify-content-between align-items-center">

                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="flex-row d-flex align-items-center">
                                                @if(!$post->retweet)
                                                    <a href="/profile/{{$post->user->id}}"
                                                       class="link-secondary text-decoration-none">
                                                        <div class="flex-row d-flex align-items-center">
                                                            <img src="{{$post->user->profile->profileImage()}}"
                                                                 id="profile_img"
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
                                                                <div>
                                                                    <b>{{\App\Models\User::find($post->tweet_user_id)->name}}</b>
                                                                </div>
                                                                <div>
                                                                    &#64;{{\App\Models\User::find($post->tweet_user_id)->username}}</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endif
                                            </div>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                                            <span>{{$post->getPostedDate()}}</span></div>
                                        @can('delete', $post)
                                            <div class="p-3">
                                <span>
                                        <i class="material-icons">delete</i>
                                    </span>
                                            </div>
                                        @endcan
                                    </div>

                                </div>
                                <a href="/p/{{$post->id}}" class="link-secondary text-decoration-none">
                                    <div class="card-img-bottom">
                                        <p style="padding-left: 20px;">{{$post->caption}}</p>
                                        @if($post->post_img)
                                            <img src="/storage/{{$post->post_img}}" class="w-100"
                                                 style="height: auto;"/>
                                        @endif
                                    </div>
                                </a>

                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center p-1">
                            <span class="d-flex flex-row align-items-center">
                                        <i class="material-icons">reply</i>
                                        <span>{{$post->replied()->count()}}</span>
                                    </span>
                                        <span class="d-flex flex-row">
                                        <reaction post-id="{{$post->id}}"
                                                  reaction-count="{{$post->getReactionCount()}}"
                                                  color="{{$post->loved->contains(auth()->user()->id)}}"></reaction>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-3"></div>

            </div>
        </div>


    </div>
@endsection
