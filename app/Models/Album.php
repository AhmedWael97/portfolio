<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['name','user_id','date'];

    public function images() {
        return $this->hasMany('\App\Models\AlbumImage','album_id','id');
    }

    public function user(){
        return $this->hasOne('\App\Models\User' ,'id','user_id');
    }
}
