@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="flex-column">
                    <h3>Edit Profile</h3>
                    <form action="/profile/{{$user->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="row mb-3">
                                <label for="name" class="col-md-6 col-form-label">Name</label>

                                <input id="name" type="text" class="form-control
                                       @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') ?? $user->name }}" autocomplete="name"
                                       autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mb-3">
                                <label for="bio" class="col-md-6 col-form-label">Bio</label>

                                <input id="bio" type="text" class="form-control
                                       @error('bio') is-invalid @enderror" name="bio"
                                       value="{{ old('bio') ?? $user->profile->bio }}" autocomplete="bio"
                                       autofocus>

                                @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mb-3">
                                <label for="location" class="col-md-6 col-form-label">location</label>

                                <input id="location" type="text" class="form-control
                                       @error('location') is-invalid @enderror" name="location"
                                       value="{{ old('location') ?? $user->profile->location }}" autocomplete="location"
                                       autofocus>

                                @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mb-3">
                                <label for="birthdate" class="col-md-6 col-form-label">Birthdate</label>

                                <input id="birthdate" type="date" class="form-control
                                       @error('birthdate') is-invalid @enderror" name="birthdate"
                                       value="{{ explode(' ', $user->profile->birthdate)[0] }}"
                                       autocomplete="birthdate"
                                       autofocus>

                                @error('birthdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mb-3">
                                <label for="website" class="col-md-6 col-form-label">Website</label>

                                <input id="website" type="text" class="form-control
                                       @error('website') is-invalid @enderror" name="website"
                                       value="{{ old('website') ?? $user->profile->website }}"
                                       autocomplete="website"
                                       autofocus>

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mb-3">
                                <label for="profile_img" class="col-md-6 col-form-label">Profile Photo</label>

                                <input id="profile_img" type="file" class="form-control
                                       @error('profile_img') is-invalid @enderror" name="profile_img"
                                       value="{{ old('profile_img') ?? $user->profile->profile_img }}"
                                       autocomplete="birthdate"
                                       autofocus>

                                @error('profile_img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mb-3">
                                <label for="header_img" class="col-md-6 col-form-label">Header Photo</label>

                                <input id="header_img" type="file" class="form-control
                                       @error('header_img') is-invalid @enderror" name="header_img"
                                       value="{{ old('header_img') ?? $user->profile->header_img }}"
                                       autocomplete="header_img"
                                       autofocus>

                                @error('header_img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <button class="btn btn-primary">Save Profile</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
@endsection
