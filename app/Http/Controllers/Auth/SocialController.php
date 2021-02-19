<?php

namespace SavyCon\Http\Controllers\Auth;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use Socialite;
use SavyCon\Models\User;
use Illuminate\Support\Facades\Hash;

use SavyCon\Jobs\Mails\User\WelcomeUserToSavycon;
use SavyCon\Jobs\Mails\Admin\InformAdminOfNewUser;

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
    public function handleProviderCallback($provider)
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
        	$newuser = new User();
        	$newuser->name = $user->name;
            $newuser->password = Hash::make($user->email);
        	$newuser->email = $user->email;
        	$newuser->role = 'vendor';
        	$newuser->save();

            WelcomeUserToSavycon::dispatch($newuser)->delay(now()->addSeconds(15));
            $admin = User::findOrFail(2);
            InformAdminOfNewUser::dispatch($newuser, $admin)->delay(now()->addSeconds(30));

        	auth()->login($newuser, true);
        }

        return redirect()->route('home');
    }
}
