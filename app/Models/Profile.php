<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function profileImage(){
        return '/storage/'. (($this->profile_img)? $this->profile_img: 'assets/img.png');
    }

    public function headerImage()
    {
        return '/storage/' . (($this->header_img) ? $this->header_img : 'assets/header.jpeg');
    }

}
