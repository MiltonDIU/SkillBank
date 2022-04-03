<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('home');
    }
    public function newsfeed(){
        $newsLetters = NewsLetter::where('is_active','1')->get();
        return view('theme.newsfeed', compact('newsLetters'));
    }

    public function newsfeedDetails($id){
        $news = NewsLetter::find($id);
        return view('theme.newsfeed-details', compact('news'));
    }
    public function profile(){
        $user = Auth::user();
        return view('theme.profile',compact('user'));
    }
    public function feedback(){
        return view('theme.feedback');
    }
}
