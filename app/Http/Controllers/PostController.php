<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;

class PostController extends Controller
{
    // Fungsi Ban
    public function suspend($id){
        $post = Post::findOrFail($id);
        $post->update(['status' => '1']);

        return redirect()->back()->with('success', 'Post Berhasil di Suspend.');
    }

    // Fungsi Store
    public function store(Request $request){
        $data = $request->validate([
            'judul_post' => 'required',
            'image' => 'image',
            'kategori_id' => 'required',        
        ]);  

        $data['slug'] = Str::slug($request->judul_post);
        $data['status'] = 0;
        $data['user_id'] = auth()->user()->id;
        
        if($request->file('image')){
            $data['image'] = $request->file('image')->store('post-img');
        }

        $newPost = Post::create($data);
        
        return redirect('/post/' . $newPost->slug)->with('success', 'Pertanyaan berhasil diunggah');
    }

    // Fungsi Update
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
        
         return redirect('/post/' . $post->slug)->with('success', 'Pertanyaan berhasil di edit');
    }

    // FUngsi Delete
    public function destroy(Post $post){
        $post->delete();
        return redirect(route('dashboard'))->with('success', 'Pertanyaan berhasil di hapus');
    }
}