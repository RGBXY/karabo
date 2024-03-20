<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;


class PostController extends Controller
{
    public function create(){
        return view('dashboard.post.create', [
            'kategoris' => Kategori::all(),
        ]);
    }

    public function store(Request $request){

        $data = $request->validate([
            'judul_post' => 'required',
            'image' => 'image',
            'kategori_id' => 'required',        
        ]);  

        $data['slug'] = Str::slug($request->judul_post);
        $data['user_id'] = auth()->user()->id;
        
        if($request->file('image')){
            $data['image'] = $request->file('image')->store('post-img');
        }

        $newPost = Post::create($data);
        
        return redirect(route('dashboard'));
    }

    public function edit(Post $post){
        return view('dashboard.post.edit', [
            'post' => $post,
            'kategoris' => Kategori::all(),
        ]);
    }

    public function update(Post $post, Request $request){
        $data = $request->validate([
            'judul_post' => 'required',
            'image' => 'image',
            'kategori_id' => 'required',
        ]);  

        if($request->file('image')){
            $data['image'] = $request->file('image')->store('post-img');
        }

         $post->update($data);
        
         return redirect(route('dashboard'))->with('success');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route('dashboard'));
    }

    public function post_jawaban(Request $request){
        // Validasi data yang dikirimkan
        $request->validate([
            'isi_jawaban' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
            'parent' => 'required'
        ]);

        // Simpan komentar ke dalam database
        Jawaban::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(), // ID pengguna yang saat ini diotentikasi
            'isi_jawaban' => $request->isi_jawaban,
            'parent' => $request->parent
        ]);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}