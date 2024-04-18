<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PostStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response{
    // Ambil slug post dari URL
    $slug = $request->route('post');

    // Temukan post berdasarkan slug
    $post = Post::where('slug', $slug)->first();   

    // Periksa apakah post diblokir dan apakah pengguna bukan admin
    $user = Auth::user();

    // Periksa apakah pengguna belum login dan post diblokir
    if (!Auth::check() && $post->status == 1) {
    // Jika pengguna belum login dan post diblokir, arahkan ke halaman login
    return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses post ini.');
    }

    // Jika pengguna sudah login dan bukan admin, dan post diblokir
    if ($user->id !== $post->user_id && !$user->hasRole('admin') && $post->status == 1) {
    // Jika pengguna bukan admin dan post diblokir, blokir akses
    return redirect()->route('home')->with('error', 'Post telah di-suspend.');
    }

    // Lanjutkan ke proses selanjutnya jika status post valid
    return $next($request);
    }
}

