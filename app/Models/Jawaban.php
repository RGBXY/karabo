<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'jawaban_konten',
        'status',
        'verified',
        'report',
        'komentar',
        'user_id',
        'post_id',
        'parent'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function childs(){
        return $this->hasMany(Jawaban::class, 'parent');
    }

   
}

