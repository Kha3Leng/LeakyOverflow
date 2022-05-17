<div class="card">
    <div class="card-body">
        <h4 class="card-title">Who to follow</h1>
        @foreach($users as $user)
            <div class="d-flex flex-row align-items-center justify-content-between">

                <a href="/profile/{{$user->id}}" class="card-link">
                    <div class="flex-row d-flex align-items-center">
                        <img src="{{$user->profile->profileImage()}}" id="profile_img"
                             class="rounded-circle p-2 m-2"
                             style="width: 70px; height: 70px;">
                        <div class="flex-column d-flex">
                            <div><b>{{$user->name}}</b></div>
                            <div>&#64;{{$user->username}}</div>
                        </div>
                    </div>
                </a>
                <div class="m-2 align-content-end text-decoration-none rounded-pill"
                     style="border: 1px solid grey; padding: 1px;">
                    <follow-button user-id="{{$user->id}}" follow="{{$follow}}"></follow-button>
                </div>
            </div>
        @endforeach</div>
</div>
