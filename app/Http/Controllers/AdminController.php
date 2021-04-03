<?php

namespace App\Http\Controllers;

use App\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware( 'auth:admin' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Take the admin to dashboard to view table with complaints
        return view( 'admin.dashboard' )->with( 'complaints', Complaint::with( 'user' )->get() );
    }

    public function update( Request $request, $id )
    {
        // Update the Complaint status
        DB::table( 'complaints' )->where( 'id', $id )->update( [
            'status' => $request->status
        ] );

        alert()->success( 'Success', 'Status Updated!' );
        return back();
    }
}
