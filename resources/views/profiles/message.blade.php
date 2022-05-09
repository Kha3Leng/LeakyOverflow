@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    @can('update', $user->profile)
                        <img src="{{$user->profile->profileImage()}}" id="profile_img"
                             class="align-items-center rounded-circle"
                             style="margin-left:10px; border: 5px solid white; height: 75px; width: 75px;">
                        <div class="mb-5">
                            <span style="font-size: 20px;"><strong>{{$user->name}}</strong></span><br>
                            <span>&#64;{{$user->username}}</span>
                        </div>

                        <a href="/p/create"
                           class="w-25 text-center align-content-end text-decoration-none rounded-pill p-1"
                           style="border: 1px solid grey; padding: 10px;">Tweet</a>
                    @endcan
                </div>
            </div>
            <div class="col-4 vh-100 d-flex flex-column py-3 border border-top-0 border-bottom-0 h-75">
                <h3><b>Messages</b></h3>
                <hr>
                <div class="d-flex flex-column p-3 justify-content-start">
                    <h1><b>Welcome to your inbox!</b></h1>
                    <p>Drop a line, share Tweets and more with private conversations between you and others on
                        Twitter.</p>
                    @can('update', $user->profile)
                        <button class="btn btn-primary text-center" data-toggle="modal" data-target="#exampleModal">
                            Write a message
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="col-5"></div>
        </div>
    </div>
@endsection
