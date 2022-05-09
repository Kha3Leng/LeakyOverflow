<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(User $user){
        $user = auth()->user();
        return view('profiles.message', compact('user'));
    }
}
