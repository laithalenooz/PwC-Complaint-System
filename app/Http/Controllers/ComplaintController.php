<?php

namespace App\Http\Controllers;

use App\Complaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $path            = Storage::disk( 's3' )->put( 'complaints', $request->image, 'public' );
        $input           = $request->all();
        $input[ 'type' ] = json_encode( $input[ 'type' ] );
        $input[ 'days' ] = json_encode( $input[ 'days' ] );

        Complaint::create(
            [
                'description' => $input[ 'description' ],
                'days'        => json_encode( $input[ 'days' ] ),
                'type'        => json_encode( $input[ 'type' ] ),
                'location'    => $input[ 'location' ],
                'time'        => $input[ 'time' ],
                'user_id'     => auth()->id(),
                'image'       => $path
            ]
        );

        alert()->success( 'Success', 'Complaint Send!' );
        return back();
    }

}
