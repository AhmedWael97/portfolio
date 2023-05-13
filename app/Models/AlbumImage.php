<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{
    use HasFactory;
    protected $fillable = ['album_id','base_64','thumbnail','photo'];


    public function album(){
        return $this->belongsTo('App\Models\Album','album_id','id');
    }
}
