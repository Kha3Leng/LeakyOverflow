@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row">
                <div class="row nopadding">
                    <div class="col-3"></div>
                    <div class="col-6 nopadding" style="border: 1px solid gainsboro">
                        <a href="/p/{{$post->id}}" class="text-decoration-none">
                            <div class="card-title">
                                <div class="flex-row d-flex align-items-center">
                                    <img src="{{$post->user->profile->profileImage()}}" id="profile_img"
                                         class="rounded-circle p-2 m-2"
                                         style="width: 70px; height: 70px;">
                                    <div class="flex-column d-flex">
                                        <div><b>{{$post->user->name}}</b></div>
                                        <div>&#64;{{$post->user->username}}</div>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span>{{$post->getPostedDate()}}</span>
                                </div>
                            </div>
                            <div class="card-img-bottom">
                                <p style="padding-left: 20px;">{{$post->caption}}</p>
                                <img src="/storage/{{$post->post_img}}" class="w-100" style="height: auto;"/>
                            </div>
                        </a>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center p-1">
                                    <span class="d-flex flex-row">
                                        <i class="material-icons">favorite</i>
                                        <reaction post-id="{{$post->id}}"
                                                  reaction-count="{{$post->getReactionCount()}}"></reaction>
                                    </span>
                                <span class="d-flex flex-row">
                                        <i class="material-icons">favorite</i>
                                        <reaction post-id="{{$post->id}}"
                                                  reaction-count="{{$post->getReactionCount()}}"></reaction>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-3"></div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
