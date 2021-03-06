<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function ($user) {
            $PublicIP = $_SERVER['REMOTE_ADDR'];
            $user->profile()->create([
                    'bio' => 'welcome to leaky overflow',
                    'location' => 'Yangon Myanmar'
                ]);
        });
    }

    public function following(){
        return $this->belongsToMany(Profile::class);
    }

    public function loving(){
        return $this->belongsToMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function tweets(){
        return $this->hasMany(Post::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function postsWithReply(){
        $post_ids = $this->replies->pluck('post_id');
        $ids = Post::whereIn('id', $post_ids)->orderBy('created_at', 'DESC')->get();
        return $ids;
    }

}
