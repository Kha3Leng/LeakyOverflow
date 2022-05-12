@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="follower-tab" data-bs-toggle="tab"
                                data-bs-target="#follower"
                                type="button" role="tab" aria-controls="follower" aria-selected="true">Follower
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="following-tab" data-bs-toggle="tab" data-bs-target="#following"
                                type="button" role="tab" aria-controls="following" aria-selected="false">Following
                        </button>
                    </li>
                </ul>
                <div class="tab-content border border-top border-left border-right border-bottom-0 p-3"
                     id="myTabContent">
                    <div class="tab-pane fade show active" id="follower" role="tabpanel" aria-labelledby="follower-tab">
                        @foreach($following_users as $profile)
                            <div class="flex-column justify-content-start">
                                <div class="flex-row d-flex align-items-center">
                                    <img src="{{$profile->profileImage()}}" id="profile_img"
                                         class="rounded-circle p-2 m-2"
                                         style="width: 70px; height: 70px;">
                                    <div class="flex-column d-flex">
                                        <div><b>{{$profile->user->name}}</b></div>
                                        <div class="text-muted">&#64;{{$profile->user->username}}</div>
                                        <div class="pt-1">{{$profile->bio}}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="following" role="tabpanel" aria-labelledby="following-tab">
                        @foreach($followers as $user)
                            <div class="flex-column justify-content-start">
                                <div class="flex-row d-flex align-items-center">
                                    <img src="{{$user->profile->profileImage()}}" id="profile_img"
                                         class="rounded-circle p-2 m-2"
                                         style="width: 70px; height: 70px;">
                                    <div class="flex-column d-flex">
                                        <div><b>{{$user->name}}</b></div>
                                        <div class="text-muted">&#64;{{$user->username}}</div>
                                        <div class="pt-1">{{$user->profile->bio}}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <div class="col-3"></div>

            </div>
        </div>
@endsection
