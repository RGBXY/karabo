<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create(){
        return view('dashboard.post.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'judul_post' => 'required',
        ]);  

         $newPost = Post::create($data);
        
         return redirect(route('dashboard'));
    }

    public function edit(Post $post){
        return view('dashboard.post.edit', ['post' => $post]);
    }

    public function update(Post $post, Request $request){
        $data = $request->validate([
            'judul_post' => 'required',
        ]);  

         $post->update($data);
        
         return redirect(route('dashboard'))->with('success', 'Post Updated');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route('dashboard'));
    }
}
