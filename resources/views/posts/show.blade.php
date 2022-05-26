@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row nopadding">
            <div class="col-2"></div>
            <div class="col-4 nopadding card">
                <div>
                    <div class="card-title">
                        <div class="flex-row d-flex align-items-center">
                            <img src="{{$post->user->profile->profileImage()}}" id="profile_img"
                                 class="rounded-circle p-2 m-2"
                                 style="width: 70px; height: 70px;">
                            <div class="flex-column d-flex">
                                <div><b><a href="/profile/{{$post->user->id}}"
                                           class="text-decoration-none">{{$post->user->name}}</a></b></div>
                                <div>&#64;{{$post->user->username}}</div>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span>{{$post->getPostedDate()}}</span>
                        </div>
                    </div>
                    <div>
                        <p style="padding-left: 20px;">{{$post->caption}}</p>
                        @if($post->post_img)
                        <img src="/storage/{{$post->post_img}}" class="w-100" style="height: auto;"/>
                        @endif
                    </div>
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
                    <div class="d-flex flex-row m-3">
                        <form action="/reply" method="post">
                            @csrf
                            <img src="{{auth()->user()->profile->profileImage()}}"
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
            </div>
            <div class="col-3">
                @foreach($post->getReply() as $reply)
                    <div>
                        <span class="text-muted">&#64;{{$reply->username}}</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span>{{$reply->replied_date}}</span>
                        <br>
                        <span
                            class="text-muted justify-content-end">Replying to &#64;{{$post->user->username}}</span><br>
                        <span>{{$reply->message}}</span>
                        <hr>
                    </div>
                @endforeach
            </div>
            <div class="col-3"></div>
        </div>

    </div>
@endsection
