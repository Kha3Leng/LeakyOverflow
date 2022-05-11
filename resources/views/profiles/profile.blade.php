@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
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
            <div class="col-6 nopadding d-flex justify-content-between align-items-center pt-3">
                <div class="p-1">{{$user->profile->website}}</div>
                <div class="p-1">{{$user->profile->location}}</div>
                <div class="p-1">{{$born_on}}</div>
                <div class="p-1">{{$joined_date}}</div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6  nopadding d-flex justify-content-start align-items-center">
                <div><strong>{{$followingCount}}</strong> Following</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div><strong>{{$followerCount}}</strong> Followers</div>
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
        @foreach($user->posts as $post)

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6 nopadding" style="border: 1px solid gainsboro">
                    <a href="/p/{{$post->id}}" class="text-decoration-none">
                        <div class="card-title">
                            <div class="flex-row d-flex align-items-center">
                                <img src="{{$post->user->profile->profileImage()}}" id="profile_img"
                                     class="rounded-circle p-2 m-2"
                                     style="width: 70px; height: 70px;">
                                <div class="flex-column d-flex">
                                    <div><b>{{$user->name}}</b></div>
                                    <div>&#64;{{$user->username}}</div>
                                </div>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
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
                            <div class="d-flex flex-row">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    Reply
                                </button>

                                <!-- Modal -->
                                <form action="/reply" method="post">
                                    @csrf
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="exampleModalLabel">
                                                        <div
                                                            class="d-flex flex-row justify-content-start align-items-center">
                                                            <img src="{{$user->profile->profileImage()}}"
                                                                 id="profile_img"
                                                                 class="rounded-circle"
                                                                 style="border: 5px solid white; height: 75px; width: 75px;">
                                                            <div class="d-flex flex-column">
                                                                <span
                                                                    style="font-size: 20px;"><strong>{{$user->name}}</strong></span>
                                                                <span>&#64;{{$user->username}}</span>
                                                            </div>
                                                            &nbsp;&nbsp;&nbsp;&nbsp&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                                                            <span>{{$post->getPostedDate()}}</span>
                                                        </div>
                                                    </h6>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{auth()->user()->profile->profileImage()}}"
                                                         id="profile_img"
                                                         class="rounded-circle pr-1"
                                                         style="border: 5px solid white; height: 75px; width: 75px;">
                                                    <span
                                                        class="text-muted justify-content-end">Replying to &#64;{{$user->username}}</span><br>
{{--                                                    <textarea name="replies" rows="5" cols="60"></textarea>--}}
                                                    <div class="row mb-3">

                                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                                        <textarea id="reply"  class="form-control
                                       @error('reply') is-invalid @enderror" name="reply" rows="5" cols="60"></textarea>

                                                        @error('reply')
                                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{--                                                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                                                    <input type="submit" value="reply" class="btn btn-primary"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
        @endforeach
    </div>
@endsection
