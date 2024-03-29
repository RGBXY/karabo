<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Post;
use Illuminate\Http\Request;

class JawabanController extends Controller
{

    

    public function store(Request $request){
        $request->request->add(['user_id' => auth()->user()->id]);
        $jawaban = Jawaban::create($request->all());
        
        $postSlug = $jawaban->post->slug;
        
         return redirect()->route('detail_post', ['post' => $postSlug]);

    }
}
