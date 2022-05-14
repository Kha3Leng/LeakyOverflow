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
//            $json = file_get_contents("http://ipinfo.io/$PublicIP/geo");
//            //Breaks down the JSON object into an array
//            $json = json_decode($json, true);
//            dd($json);
//            //This variable is the visitor's county
//            $country = $json['country'];
//            //This variable is the visitor's region
//            $region = $json['region'];
//            //This variable is the visitor's city
//            $city = $json['city'];
            $user->profile()->create([
                    'bio' => 'welcome to leaky overflow',
                    'location' => '27 Pyay Rd, #100 5 Nes Avenue, Yangon Myanmar'
                ]);
        });
    }

    public function following(){
        return $this->belongsToMany(Profile::class);
    }

    public function loving(){
        return $this->belongsToMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

}
