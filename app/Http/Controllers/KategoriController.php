<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Kategori;
use App\Models\Post;

class KategoriController extends Controller
{
    public function kategori(Request $request){
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

    public function create(){
        return view('admin.kategori.add_kategori');
    }    

    public function store(Request $request){
        $data = $request->validate([
            'nama_kategori' => 'required|unique:kategoris',
        ]);  

        $data['slug'] = Str::slug($request->nama_kategori);

         $newPost = Kategori::create($data);
        
         return redirect('/dashboard-kategori');
    }

    public function edit(Kategori $kategori){
        return view('admin.kategori.edit', ['kategori' => $kategori]);
    }

    public function update(Kategori $kategori, Request $request){
        $data = $request->validate([
            'nama_kategori' => 'required|unique:kategoris',
        ]);  

        $kategori->update($data);

        return redirect(route('dashboard.kategori'));

    }

    public function destroy(Kategori $kategori){
        $kategori->delete();
        return redirect()->route('dashboard.kategori');
    }
}
