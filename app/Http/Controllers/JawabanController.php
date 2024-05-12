<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JawabanController extends Controller
{

    // Ckeditor Upload Image
    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
      
            $path = $request->file('upload')->storeAs(
                'media', $fileName, 'public'
            );
    
            $url = Storage::url($path);
  
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

    // Verifikasi Jawaban
    public function ban_jawaban($id)
    {
        $jawaban = Jawaban::findOrFail($id);
        $jawaban->update(['status' => '1']);

        return redirect()->back()->with('success', 'Jawaban berhasil ban.');
    }

    public function batal_ban_jawaban($id)
    {
        $jawaban = Jawaban::findOrFail($id);
        $jawaban->update(['status' => '0']);

        return redirect()->back()->with('success', 'Berhasil dibatalkan.');
    }

    // Verifikasi Jawaban
    public function verifikasi($id)
    {
        $jawaban = Jawaban::findOrFail($id);
        $jawaban->update(['verified' => '1']);

        return redirect()->back()->with('success', 'Jawaban berhasil diverifikasi.');
    }

    public function batal_verifikasi($id)
    {
        $jawaban = Jawaban::findOrFail($id);
        $jawaban->update(['verified' => '0']);

        return redirect()->back()->with('success', 'Berhasil dibatalkan');
    }

    // Jawaban dan Komentar
    public function post_jawaban(Request $request){
        // Lakukan validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'jawaban_konten' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent' => 'required'
        ]);
    
        // Jika validasi gagal, kembalikan dengan pesan kesalahan
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
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
            // Lakukan validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'jawaban_konten' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent' => 'required'
        ]);
        
        // Jika validasi gagal, kembalikan dengan pesan kesalahan
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        // Tambahkan user_id ke dalam request
        $request->merge(['user_id' => auth()->user()->id]);
        
        // Simpan jawaban ke dalam database
        $jawaban = Jawaban::create($request->all());
            
        // Dapatkan slug dari post yang terkait dengan jawaban
        $postSlug = $jawaban->post->slug;
            
        // Redirect ke halaman detail post dengan slug yang sesuai
        return redirect()->route('detail_post', ['post' => $postSlug]);
    }

    // Fungsi Update 
    public function update(Jawaban $jawaban, Request $request){
        $data = $request->validate([
            'jawaban_konten' => 'required',
        ]);  

         $jawaban->update($data);
        
         return redirect()->back()->with('success', 'Jawaban berhasil diedit.');
    }

    // Fungsi Hapus
    public function destroy(Jawaban $jawaban){
        $jawaban->delete();
        return redirect()->back()->with('success', 'Jawaban berhasil dihapus.');
    }

}
