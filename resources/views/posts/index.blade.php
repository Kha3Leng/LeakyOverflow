@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 border p-5">
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
            <div class="col-3"></div>
        </div>
        @foreach($posts as $post)
            <div class="row">
                <div class="row nopadding">
                    <div class="col-3"></div>
                    <div class="col-6 nopadding" style="border: 1px solid gainsboro">

                        <div class="card-title">
                            <a href="/profile/{{$post->user->id}}" class="link-secondary text-decoration-none">
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
                            </a>
                        </div>
                        <a href="/p/{{$post->id}}" class="link-secondary text-decoration-none">
                            <div class="card-img-bottom">
                                <p style="padding-left: 20px;">{{$post->caption}}</p>
                                <img src="/storage/{{$post->post_img}}" class="w-100" style="height: auto;"/>
                            </div>
                        </a>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center p-1">
                                    <span class="d-flex flex-row align-items-center">
                                        <i class="material-icons">reply</i>
                                        <span>{{$post->replied()->count()}}</span>
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
