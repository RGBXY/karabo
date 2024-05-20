<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Kategori;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;

class AppController extends Controller
{

    // User

    // Fungsi Jawaban Perpos
    public function jawabanPerPost(){
    $jawabanPerPost = [];
    
    $posts = Post::latest()->get();

    foreach ($posts as $post) {
        $jawabanPerPost[$post->id] = $post->jawaban()->where('parent', 0)->count();
    }

    return $jawabanPerPost;
    }

    // Fungsi Home
    public function index(){
        $jawabanPerPost = $this->jawabanPerPost();

        $kategoris = Kategori::orderBy('id', 'desc')->get();

        $user_top = User::withCount(['jawaban' => function ($query) {
            $query->where('status', 0);
        }])->orderByDesc('jawaban_count')->limit(5)->get();
        
        $kategori_top = Kategori::withCount('post')->orderByDesc('post_count')->limit(7)->get(); 
    
        $title = "";
        if(request('kategori')){
            $kategori = Kategori::firstWhere('slug', request('kategori'));
            if($kategori){
                $title = "Topik " . $kategori->nama_kategori;
            } else {
                $title = "Kategori tidak ditemukan";
            }
        }

        return view('home', [
            'title' => $title,
            'posts' => Post::filter(request(['search', 'kategori']))->inRandomOrder()->paginate(30),
            'jawabanPerPost' => $jawabanPerPost,
            'kategoris' => $kategoris,
            'user_top' => $user_top,
            'kategori_top' => $kategori_top,
        ]);
    }

    // Fungsi Create
    public function create_post(){
        return view('dashboard.post.create', [
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
        ]);
    }

    // Fungsi Dashboard Pertanyaan User
    public function dashboard_post(){
        $user_top = User::withCount('jawaban')->orderByDesc('jawaban_count')->get(5);
        $kategori_top = Kategori::withCount('post')->orderByDesc('post_count')->limit(7)->get(); 
        return view('dashboard.post.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->paginate(15),
            'user_top' => $user_top,
            'kategori_top' => $kategori_top,
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
        ]);
    }

    // Fungsi Dashboard Jawaban (User)
    public function dashboard_jawaban(){

        $user_top = User::withCount('jawaban')->orderByDesc('jawaban_count')->get(5);
        $kategori_top = Kategori::withCount('post')->orderByDesc('post_count')->limit(7)->get(); 
        
        $userId = auth()->id();

        $postsWithAnswers = Post::whereHas('jawaban', function ($query) use ($userId) {
            $query->whereNotNull('jawaban_konten') 
                  ->where('user_id', $userId); 
        })->get();

        return view('dashboard.post.jawaban', [
            'post' => Post::where('user_id', auth()->user()->id)->get(),
            'jawabans' => Jawaban::where('user_id', auth()->user()->id)->where('parent', 0)->paginate(10),
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
            'user_top' => $user_top,
            'kategori_top' => $kategori_top,
            'postsWithAnswers' => $postsWithAnswers,
        ]);
    }
    
    public function suspend_exp(){
        return view('post.suspend');
    }

    public function pedoman(){
        return view('post.pedoman');
    }

    // Fungsi Pertanyaan Tanpa Jawaban
    public function jawab_view()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        
        $jawabanPerPost = $this->jawabanPerPost();
    
        $kategoris = Kategori::orderBy('id', 'desc')->get();

        $jawab = Post::where('status', 0)->doesntHave('jawaban')->paginate(30);
        
        return view('post.jawab', compact('jawab'), [
            'jawabanPerPost' => $jawabanPerPost,
            'posts' => $posts,
            'kategoris' => $kategoris,
        ]);
    }

    // Fungsi Detail Post 
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
    
    // Funsi Dashboard (Admin)
    public function dashboard_admin(){
        $kategoris = Kategori::orderBy('id', 'desc')->get();
        return view('admin.index', [
            'posts' => Post::latest()->filter(request(['search', 'kategori']))->paginate(50),
            'kategoris' => $kategoris,
        ]);
    }

    // Fungsi Dashboard Kategori (Admin)
    public function dashboard_kategori(){
        return view('admin.kategori', [
            'kategoris' => Kategori::latest()->filter(request(['search', 'kategori']))->paginate(50),
            'jumlahPostKategori' => Kategori::withCount('post')->orderByDesc('post_count')->get(),
        ]);
    }

    // Fungsi Kategori 
    public function kategori(){
        $posts = Post::orderBy('id', 'desc')->take(2)->get();
        
        // Inisialisasi array untuk menyimpan jumlah jawaban berdasarkan post ID
        $jawabanPerPost = [];
    
        // Menghitung jumlah jawaban untuk setiap post
        foreach ($posts as $post) {
            $jawabanPerPost[$post->id] = $post->jawaban()->where('parent', 0)->count();;
        }

        return view('kategori.kategori',[
            'kategoris' => Kategori::all(),
            'posts' => $posts,
        ]);
    }

    // Fungsi Kategori Detail
    public function kategori_detail (Kategori $kategori){
        $posts = Post::orderBy('id', 'desc')->get();
        
        // Inisialisasi array untuk menyimpan jumlah jawaban berdasarkan post ID
        $jawabanPerPost = [];
    
        // Menghitung jumlah jawaban untuk setiap post
        foreach ($posts as $post) {
            $jawabanPerPost[$post->id] = $post->jawaban()->where('parent', 0)->count();;
        }

        return view('kategori.kategori_detail',[
            'jawabanPerPost' => $jawabanPerPost,
            'kategoris' => Kategori::all(),
            'posts' => $kategori->post,
        ]);
    } 


}
