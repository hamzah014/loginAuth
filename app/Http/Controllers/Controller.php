<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\SocialAccount;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // public function naverCallback()
    // {
    //     //dump(auth()->user());
    //     $naveruser = Socialite::driver('naver')->user();
    //     //dump($naveruser);

    //     $socialacc = SocialAccount::where('social_id', $naveruser->id)->with('user')->first();
    
    //     dump($socialacc);

    //     if($socialacc)
    //     {

    //     }

    //     return view('home');
    // }
}
