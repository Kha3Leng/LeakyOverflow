@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="flex-column">
                    <img src="/svg/alena.jpeg" id="bg_img" class="h-50 w-100"/>
                    <div class="d-flex align-items-center justify-content-between">
                        <img src="/svg/alena1.jpg" id="profile_img" class="w-25 h-25" style="margin-top: -20px;">
                        <a href="#" class="align-content-end">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 dlf">
                <h3><strong>{{$user->name}}</strong></h3>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
@endsection
