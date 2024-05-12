<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Suspend View
    public function suspend_view($slug){
        return view('post.suspend', [
            'post' => Post::where('slug', $slug)->first()
        ]);
    }

    // Fungsi Suspend
    public function suspend($id){
        $post = Post::findOrFail($id);
        $post->update(['status' => '1']);

        return redirect()->back()->with('success', 'Post Berhasil di Suspend.');
    }

    // Fungsi Diaktifkan kembali
    public function unsuspend($id){
        $post = Post::findOrFail($id);
        $post->update(['status' => '0']);

        return redirect()->back()->with('success', 'Post Berhasil di Unsuspend.');
    }

    // Store
    public function store(Request $request){
        $validatedData = $request->validate([
            'judul_post' => 'required|max:250|min:10',
            'image' => 'max:3000|mimes:jpg,jpeg,png,webp',
            'kategori_id' => 'required',        
        ], [
            // Pesan kesalahan khusus untuk setiap aturan validasi
            'judul_post.required' => 'Kolom pertanyaan harus diisi.',
            'judul_post.max' => 'Pertanyaan tidak boleh lebih dari 250 karakter.',
            'judul_post.min' => 'Pertanyaan posting tidak boleh kurang dari 10 karakter',
            'image.max' => 'Gambar tidak boleh lebih dari 3mb.',
            'image.mimes' => 'Gambar harus berupa file dengan tipe JPG, JPEG, PNG, atau WEBP.',
            'kategori_id.required' => 'Kategori harus dipilih.',
        ] 
    );
    
        $validatedData['slug'] = Str::slug($request->judul_post);
        $validatedData['status'] = 0;
        $validatedData['user_id'] = auth()->user()->id;
        
        $judulPost = $request->judul_post;
        $postExists = Post::where('judul_post', $judulPost)->exists();
    
        if ($postExists) {
            return redirect()->back()->withInput()->withErrors(['judul_post' => 'Pertanyaan sudah ada.']);
        }

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-img');
        }
    
        $newPost = Post::create($validatedData);
        
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
        return Auth::user()->hasRole('admin') ? redirect(route('dashboard.admin')) : redirect(route('dashboard')) ->with('success', 'Pertanyaan berhasil di hapus');
    }
}