<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'kategoris' => Kategori::orderBy('id','desc')->get(),
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {        
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('profile_image')) {
            // Ambil user yang sedang login
            $user = $request->user();
        
            // Simpan nama file foto sebelumnya
            $previousImage = $user->profile_image;
        
            // Upload foto baru
            $image = $request->file('profile_image');
            $imageName = $image->store('profile_images');
        
            // Update nama file di database
                $user->profile_image = $imageName;
                $user->save();
        
            // Hapus foto sebelumnya dari storage jika ada
            if ($previousImage) {
                Storage::delete($previousImage);
            }
        }
        

        $request->user()->save();
        
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
