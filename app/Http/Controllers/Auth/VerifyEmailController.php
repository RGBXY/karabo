<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;
use App\Providers\RouteServiceProvider;

class VerifyEmailController extends Controller
{
    use RedirectsUsers;

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            // Change redirect to intended()
            return redirect()->intended($this->redirectPath());
        }
    
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
    
        // If verification is successful, redirect with verified flag
        return redirect()->intended($this->redirectPath())->with('verified', true);
    }
    

    /**
 * Get the post register / login redirect path.
 *
 * @return string
 */
public function redirectPath()
{
    return '/';
}
}
