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
            $jawabanPerPost[$post->id] = $post->jawaban()->where('parent', 0)->count();
        }
    
        // Mengambil semua kategori
        $kategoris = Kategori::orderBy('id', 'desc')->get();

        $user_top = User::withCount('jawaban')->orderByDesc('jawaban_count')->get(5);
    
        // Mengirim data ke view 'home'
        return view('home', [
            'jawabanPerPost' => $jawabanPerPost,
            'posts' => $posts,
            'kategoris' => $kategoris,
            'user_top' => $user_top,
        ]);
    }

    public function dashboard_post(){
        return view('dashboard.post.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
        ]);
    }

    public function dashboard_kategori(){
        return view('admin.kategori.index', [
            'posts' => Post::orderBy('id', 'desc')->get(),
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
        ]);
    }

    public function jawab_view()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        
        // Inisialisasi array untuk menyimpan jumlah jawaban berdasarkan post ID
        $jawabanPerPost = [];
    
        // Menghitung jumlah jawaban untuk setiap post
        foreach ($posts as $post) {
            $jawabanPerPost[$post->id] = $post->jawaban()->where('parent', 0)->count();
        }
    
        // Mengambil semua kategori
        $kategoris = Kategori::orderBy('id', 'desc')->get();

        // Ambil post yang belum memiliki jawaban
        $jawab = Post::doesntHave('jawaban')->get();
        
        // Kirim data ke tampilan
        return view('jawab', compact('jawab'), [
            'jawabanPerPost' => $jawabanPerPost,
            'posts' => $posts,
            'kategoris' => $kategoris,
        ]);
    }

    public function detail_post($slug){
        
        $post = Post::where('slug', $slug)->first();
    
        $jawabanPerPost = [];
        
        if($post) {
            $jawabanPerPost[$post->id] = $post->jawaban()->where('parent', 0)->count();
        }
    
        $kategoris = Kategori::orderBy('id', 'desc')->get();

        $jawab = Post::doesntHave('jawaban')->limit(5)->get()->shuffle();
        
        return view('detail_post', [
            'post' => $post,
            'posts' => $jawab,
            'kategoris' => $kategoris,
            'jawabanPerPost' => $jawabanPerPost,
        ]);

        
    }
    
    



}
