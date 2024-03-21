<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class AppController extends Controller
{
    public function index(){
        // Mengambil semua post
        $posts = Post::orderBy('id', 'desc')->get();
        
        // Inisialisasi array untuk menyimpan jumlah jawaban berdasarkan post ID
        $jawabanPerPost = [];
    
        // Menghitung jumlah jawaban untuk setiap post
        foreach ($posts as $post) {
            $jawabanPerPost[$post->id] = Jawaban::where('post_id', $post->id)->count();
        }
    
        // Mengambil semua kategori
        $kategoris = Kategori::orderBy('id', 'desc')->get();
    
        // Mengirim data ke view 'home'
        return view('home', [
            'jawabanPerPost' => $jawabanPerPost,
            'posts' => $posts,
            'kategoris' => $kategoris,
        ]);
    }

    public function dashboard_post(){
        return view('dashboard.post.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function dashboard_kategori(){
        return view('admin.kategori.index', [
            'posts' => Post::orderBy('id', 'desc')->get(),
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
        ]);
    }
}
