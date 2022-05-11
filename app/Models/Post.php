<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;

class Post extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function loved(){
        return $this->belongsToMany(User::class);
    }

    public function getPostedDate(){
        // return date string
        return $this->created_at->format('F d, Y');
    }

    public function getReactionCount(){
        $result = DB::select("select count(user_id) as reactionCount from post_user where post_id = ?", [$this->id]);
        return $result[0]->reactionCount;
    }

    public function replied(){
        return $this->hasMany(Reply::class);
    }

}
