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
     

    public function store(Request $request){
        $data = $request->validate([
            'nama_kategori' => 'required|unique:kategoris',
        ]);  

        $data['slug'] = Str::slug($request->nama_kategori);

         $newPost = Kategori::create($data);
        
         return redirect(route('dashboard.kategori'))->with('success', 'Kategori Berhasil di Buat.');
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
