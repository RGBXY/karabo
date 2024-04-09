<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Post;
use Illuminate\Http\Request;

class JawabanController extends Controller
{

    public function post_jawaban(Request $request){
        // Validasi data yang dikirimkan
        $request->validate([
            'jawaban_konten' => 'required|longText|max:255',
            'post_id' => 'required|exists:posts,id',
            'parent' => 'required'
        ]);

        // Simpan komentar ke dalam database
        Jawaban::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(), // ID pengguna yang saat ini diotentikasi
            'jawaban_konten' => $request->jawaban_konten,
            'parent' => $request->parent
        ]);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function store(Request $request){
        $request->request->add(['user_id' => auth()->user()->id]);
        $jawaban = Jawaban::create($request->all());
        
        $postSlug = $jawaban->post->slug;
        
        return redirect()->route('detail_post', ['post' => $postSlug]);

    }

    public function update(Jawaban $jawaban, Request $request){
        $data = $request->validate([
            'jawaban_konten' => 'required',
        ]);  

         $jawaban->update($data);
        
         return redirect(route('dashboard_jawaban'))->with('success');
    }

    public function destroy(Jawaban $jawaban){
        $jawaban->delete();
        return redirect(route('dashboard_jawaban'))->with('success');
    }

}
