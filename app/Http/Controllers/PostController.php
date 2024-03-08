<?php

namespace App\Http\Controllers;

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
            'kategori_id' => 'required',        
        ]);  

        $data['slug'] = Str::slug($request->judul_post);
        $data['user_id'] = auth()->user()->id;

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
            'kategori_id' => 'required',
        ]);  

         $post->update($data);
        
         return redirect(route('dashboard'))->with('success', 'Post Updated');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route('dashboard'));
    }
}
