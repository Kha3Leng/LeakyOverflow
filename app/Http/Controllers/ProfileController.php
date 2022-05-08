<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Nette\Utils\DateTime;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $profile = $user->profile;
        $joined_date = '';
        $born_on = '';

        if ($profile->birthdate) {
            $born_on .= 'Born ';
//            dd($profile->birthdate);
//            dd();
            $born_on .= date_format(DateTime::createFromFormat('Y-m-d H:i:s', $profile->birthdate), 'F d, Y');
        }

        if ($profile->created_at) {
            $joined_date .= 'Joined ';
            $joined_date .= date_format($profile->created_at, 'F Y');
        }

        $postCount = Cache::remember('count.posts' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            });

        $followerCount = Cache::remember('count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember('count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });

        $follow = (auth()->user())? auth()->user()->following->contains($user->id) : false;
        return view('profiles.profile', compact('follow', 'postCount', 'followerCount', 'followingCount', 'profile', 'user', 'joined_date', 'born_on'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = auth()->user();
        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user->profile);
        // this current user is authorized to update profile according to ProfilePolicy.

        $data = $request->validate([
            'name' => 'required',
            'birthdate' => 'date',
            'name' => 'required',
            'website' => 'url',
            'bio' => 'string',
            'location' => 'string'
        ]);
        $imageArray = [];
        if ($request['profile_img']) {
            $profile_img_path = request('profile_img')->store('profile', 'public');
            $profile_img = Image::make(public_path("storage/$profile_img_path"))->fit(1200, 1200);
            $profile_img->save();
            $imageArray = ['profile_img' => $profile_img_path];
        }

        if ($request['header_img']) {
            $header_img_path = request('header_img')->store('header', 'public');
            $header_img = Image::make(public_path("storage/$header_img_path"))->fit(1200, 1200);
            $header_img->save();
            $imageArray = array_merge($imageArray, ['header_img' => $header_img_path]);
        }
//        dd(array_key_exists('name', $data));
        if (array_key_exists('name', $data)) {
            auth()->user()->name = $data['name'];
            auth()->user()->save();
            unset($data['name']);
        }
        auth()->user()->profile()->update(
            array_merge($data, $imageArray ?? [])
        );

        return redirect("profile/{$user->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
