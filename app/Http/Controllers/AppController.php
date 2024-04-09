<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class AppController extends Controller
{

    // User
    public function jawabanPerPost(){
    $jawabanPerPost = [];
    
    $posts = Post::latest()->get();

    foreach ($posts as $post) {
        $jawabanPerPost[$post->id] = $post->jawaban()->where('parent', 0)->count();
    }

    return $jawabanPerPost;

    }

    public function index(){
        $jawabanPerPost = $this->jawabanPerPost();

        $kategoris = Kategori::orderBy('id', 'desc')->get();

        $user_top = User::withCount('jawaban')-> orderByDesc('jawaban_count')->get(5);

        $kategori_top = Kategori::withCount('post')->orderByDesc('post_count')->get(7); 
    
        $title = "";
        if(request('kategori')){
            $kategori = Kategori::firstWhere('slug', request('kategori'));
            $title = "Topik " . $kategori->nama_kategori;
        }

        return view('home', [
            'title' => $title,
            'posts' => Post::latest()->filter(request(['search', 'kategori']))->get(),
            'jawabanPerPost' => $jawabanPerPost,
            'kategoris' => $kategoris,
            'user_top' => $user_top,
            'kategori_top' => $kategori_top,
        ]);
    }

    public function dashboard_post(){

        $user_top = User::withCount('jawaban')->orderByDesc('jawaban_count')->get(5);
        $kategori_top = Kategori::withCount('post')->orderByDesc('post_count')->get(7);

        return view('dashboard.post.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
            'user_top' => $user_top,
            'kategori_top' => $kategori_top,
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
        ]);
    }

    public function dashboard_jawaban(){

        $user_top = User::withCount('jawaban')->orderByDesc('jawaban_count')->get(5);
        $kategori_top = Kategori::withCount('post')->orderByDesc('post_count')->get(7);

        return view('dashboard.post.jawaban', [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
            'jawabans' => Jawaban::where('user_id', auth()->user()->id)->where('parent', 0)->get(),
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
            'user_top' => $user_top,
            'kategori_top' => $kategori_top,
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
        
        $jawabanPerPost = $this->jawabanPerPost();
    
        $kategoris = Kategori::orderBy('id', 'desc')->get();

        $jawab = Post::doesntHave('jawaban')->get();
        
        return view('post.jawab', compact('jawab'), [
            'jawabanPerPost' => $jawabanPerPost,
            'posts' => $posts,
            'kategoris' => $kategoris,
        ]);
    }

    public function detail_post($slug){
        
        $post = Post::where('slug', $slug)->first();
    
        $jawabanPerPost = $this->jawabanPerPost();
    
        $kategoris = Kategori::orderBy('id', 'desc')->get();

        $jawaban = Jawaban::orderBy('id', 'desc')->get();

        $jawab = Post::doesntHave('jawaban')->limit(5)->get()->shuffle();
        
        return view('post.detail_post', [
            'post' => $post,
            'posts' => $jawab,
            'kategoris' => $kategoris,
            'jawabans' => $jawaban,
            'jawabanPerPost' => $jawabanPerPost,
        ]);        
    }
    
    // Admin
    public function dashboard_admin(){
        $posts = Post::orderBy('id', 'desc')->get();
        $kategoris = Kategori::orderBy('id', 'desc')->get();
        return view('admin.index', [
            'posts' => $posts,
            'kategoris' => $kategoris,
        ]);
    }



}
