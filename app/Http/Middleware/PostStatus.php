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

    $slug = $request->route('post');
    $post = Post::where('slug', $slug)->first();   
    $user = Auth::user();
        
    // Kalau Belum Login dan Post di Suspend
    if (!$user && $post->status == 1) {
    return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses post ini.');
    }                       

    // Kalau Sudah Login dan Post di Suspend
    if ($user && !$user->hasRole('admin') && $post->status == 1) {
    return redirect()->route('suspend')->with('error', 'Post telah di-suspend.');
    }

    return $next($request);
    }
}

