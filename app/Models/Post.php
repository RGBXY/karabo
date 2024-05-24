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
        'status',
        'report',
        'user_id',
    ];
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('judul_post', 'like', '%' . $search . '%');
        });

        $query->when($filters['kategori'] ?? false, function($query, $kategori){
            return $query->whereHas('kategori', function($query) use ($kategori){
                $query->where('slug', $kategori);
            });
        });
    }
    

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jawaban(){
        return $this->hasMany(Jawaban::class, 'post_id');
    }

    public function hasAnswer(){
        return $this->jawaban()->count() > 0;
    }
}


