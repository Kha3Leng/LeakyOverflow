<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nette\Utils\DateTime;

class Post extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getPostedDate(){
//        return date_format(DateTime::createFromFormat('Y-m-d H:i:s', $this->created_at), 'F d, Y').;
        return $this->created_at->format('F d, Y');
    }
}
