<?php

namespace SavyCon\Http\Controllers\Auth;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use Socialite;
use SavyCon\Models\User;

class SocialController extends Controller
{
    /**
     * @param Provider {Twitter, Linkedin, Facebook, Google}
     *
     * Redirect the user to the @param authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param Provider {Twitter, Linkedin, Facebook, Google}
     *
     * Obtain the user information from @param.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider, $role)
    {
    	try {
        	$user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
        	return redirect()->route('login')->with('status', 'Something went wrong while authenticating.');
        }
        
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
        	auth()->login($existingUser, true);
        } else {
        	$new = new User();
        	$new->name = $user->name;
        	$new->email = $user->email;
        	$new->role = $role;
        	$user->save();

        	auth()->login($new, true);
        }

        return redirect()->route('home');
    }
}
