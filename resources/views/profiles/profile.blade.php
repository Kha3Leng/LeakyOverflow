@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="flex-column">
                    <img src="{{$profile->headerImage()}}" id="bg_img" class="w-100" style="height: 200px;"/>
                    <div class="d-flex align-items-center justify-content-between">
                        <img src="{{$profile->profileImage()}}" id="profile_img" class="rounded-circle w-25 h-25 p-2" style="margin-top: -50px;">
                        <a href="#" class="align-content-end">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 pt-2">
                <h3><strong>{{$user->name}}</strong></h3>
                <span>&#64;{{$user->username}}</span>

                <div class="pt-2">
                    <strong>{{$user->profile->bio}}</strong>
                </div>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 d-flex justify-content-between align-items-center pt-2">
                <div>{{$user->profile->location}}</div>
                <div>{{$born_on}}</div>
                <div>{{$joined_date}}</div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 d-flex justify-content-start align-items-center">
                <div><strong>21231</strong> Following</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div><strong>21231</strong> Followers</div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <hr>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
            </div>
            <div class="col-3"></div>
        </div>
    </div>
@endsection
