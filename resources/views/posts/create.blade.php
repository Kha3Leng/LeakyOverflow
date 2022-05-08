@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form action="/p" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="row mb-3">
                            <label for="caption" class="col-md-6 col-form-label">Caption</label>

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
                            <label for="post_img" class="col-md-6 col-form-label">post_img</label>

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
    </div>
@endsection
