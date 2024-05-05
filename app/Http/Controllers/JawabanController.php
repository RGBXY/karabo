<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->back()->with('success', 'Jawaban berhasil batal ban.');
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

        return redirect()->back()->with('success', 'Jawaban berhasil');
    }

    // Jawaban dan Komentar
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

    // Fungsi Store
    public function store(Request $request){
        $request->request->add(['user_id' => auth()->user()->id]);
        $jawaban = Jawaban::create($request->all());
        
        $postSlug = $jawaban->post->slug;
        
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
