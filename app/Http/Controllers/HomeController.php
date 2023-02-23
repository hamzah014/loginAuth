<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dump(auth()->user());
        return view('home');
    }
    public function indexAdmin()
    {
        //dump(auth()->user());
        return view('admin.home');
    }

    public function naverCallback()
    {
        //dump(auth()->user());
        $naveruser = Socialite::driver('naver')->user();
        dump($naveruser);
        //return view('home');
    }
}
