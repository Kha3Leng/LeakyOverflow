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

    public function getReply(){
        $result = DB::select("select r.message, r.created_at replied_date, r.user_id, u.username from reply r, users u where post_id = ? and r.user_id = u.id order by r.created_at desc", [$this->id]);
        return $result;
    }

    public function getReplyCount(){
        return $this->replied()->count();
    }

    public function ownReply(User $user){
        return $this->replied()->where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
    }

    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        static::deleting(function($post){
            $post->replied()->delete();
            $total_delete = DB::table('post_user')->where('post_id', $post->id)->delete();
        });
    }

}
