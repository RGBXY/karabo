<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Kategori;
use App\Models\Post;

class KategoriController extends Controller
{
    // Fungsi Kategori
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

    public function store(Request $request){
        $data = $request->validate([
            'nama_kategori' => 'required|unique:kategoris',
        ]);  

        $data['slug'] = Str::slug($request->nama_kategori);

         $newPost = Kategori::create($data);
        
         return redirect('/dashboard-kategori')->with('success', 'Kategori Berhasil di Buat.');
    }

    public function update(Kategori $kategori, Request $request){
        $data = $request->validate([
            'nama_kategori' => 'required|unique:kategoris',
        ]);  

        $kategori->update($data);

        return redirect(route('dashboard.kategori'))->with('success', 'Kategori Berhasil di Edit.');

    }

    public function destroy(Kategori $kategori){
        $kategori->delete();
        return redirect()->route('dashboard.kategori')->with('success', 'Kategori Berhasil di Hapus.');
    }
}
