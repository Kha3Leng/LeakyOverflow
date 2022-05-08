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
                <div><strong>21231</strong> Following</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div><strong>21231</strong> Followers</div>
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
            <div>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 nopadding" style="border: 1px solid gainsboro">
                        <div class="card-title">
                            <div class="flex-row d-flex align-items-center">
                                <img src="{{$post->user->profile->profileImage()}}" id="profile_img"
                                    class="rounded-circle p-2 m-2"
                                    style="width: 70px; height: 70px;">
                                <div class="flex-column d-flex">
                                    <div><b>{{$user->name}}</b></div>
                                    <div>&#64;{{$user->username}}</div>
                                </div>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span>{{$post->getPostedDate()}}</span>
                            </div>
                        </div>
                        <div class="card-img-bottom">
                            <p style="padding-left: 20px;">{{$post->caption}}</p>
                            <img src="/storage/{{$post->post_img}}" class="w-100" style="height: auto;"/>
                        </div>
                        <div class="card-footer">
                            <hr>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
