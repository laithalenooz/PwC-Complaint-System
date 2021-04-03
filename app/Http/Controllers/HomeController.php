<?php

namespace App\Http\Controllers;

use App\Complaint;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Take user to homepage to view the form with the complaints table including status
        return view( 'home' )->with( 'complaints', Complaint::with( 'user' )->where( 'user_id', auth()->id() )->get() );
    }
}
