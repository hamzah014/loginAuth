<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\SocialAccount;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/home";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login (Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (Auth::user()->role == "admin") {
                return redirect()->route('admin.home');
            }elseif (Auth::user()->role == "member"){
                return redirect()->route('home');
            }
            

        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }

    }

    public function naverLogin()
    {
        return Socialite::driver('naver')->redirect();
    }

    public function naverCallback()
    {
        try{
        //dump(auth()->user());
        $naveruser = Socialite::driver('naver')->user();

        $user = User::where('email', $naveruser->email)->with('socialAccount')->first();

        if($user)
        {
            $user_id = $user->id;

            //check if there is data of social account attached, if no insert social acc data
            if(count($user->socialAccount) < 1){

                $socid = $naveruser->id;
                $name = $naveruser->name;
                $email = $naveruser->email;
                $avatar = $naveruser->avatar;
                $nickname = $naveruser->nickname;
                $token = $naveruser->token;
                $refreshToken = $naveruser->refreshToken;
                $expired_in = $naveruser->expired_in;

                $user->socialAccount()->create([

                    'social_id'=> $socid,
                    'user_id'=> $user_id,
                    'token'=> $token,
                    'refreshToken'=> $refreshToken,
                    'expired_in'=> $expired_in,
                    'nickname'=> $nickname,
                    'email'=> $email,
                    'name'=> $name,
                    'avatar'=> $avatar,

                ]);

            }

            Auth::login($user);
            return view('home');

        }else{

            return redirect()->route('logout');
        }


        }catch(\Exception $e)
        {
            return redirect()->route('login');
        }
    }
}
