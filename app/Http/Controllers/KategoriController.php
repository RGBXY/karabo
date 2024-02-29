<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function create(){
        return view('dashboard.kategori.add_kategori');
    }    

    public function store(Request $request){
        $data = $request->validate([
            'nama_kategori' => 'required',
        ]);  

         $newPost = Kategori::create($data);
        
         return redirect('/dashboard-kategori');
    }

    public function edit(Kategori $kategori){
        return view('dashboard.kategori.edit', ['kategori' => $kategori]);
    }

    public function update(Kategori $kategori, Request $request){
        $data = $request->validate([
            'nama_kategori' => 'required',
        ]);  

        $kategori->update($data);

        return redirect(route('dashboard.kategori'));

    }

    public function destroy(Kategori $kategori){
        $kategori->delete();
        return redirect()->route('dashboard.kategori');
    }
}
