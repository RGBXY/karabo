<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_post',
        'image',
        'kategori_id',
        'slug',
        'user_id',
    ];
    
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jawaban(){
        return $this->hasMany(Jawaban::class, 'post_id');
    }

}


