<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Post;

class AppController extends Controller
{
    public function index(){
        return view('home', [
            'posts' => Post::orderBy('id', 'desc')->get(),
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
        ]);
    }

    public function dashboard_post(){
        return view('dashboard.post.index', [
            'posts' => Post::orderBy('id', 'desc')->get(),
        ]);
    }

    public function dashboard_kategori(){
        return view('dashboard.kategori.index', [
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
        ]);
    }
}
