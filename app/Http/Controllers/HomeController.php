<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $recipes = DB::table('recipes')->where('created_by', Auth::user()->id)->get();

        //dd(Auth::user());
        //dd($recipes);

        return view('home', ['recipes' => $recipes]);
    }
}
