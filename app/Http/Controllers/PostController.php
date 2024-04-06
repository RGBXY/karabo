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

    public function upload(Request $request)
    {
       if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            
            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
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
}