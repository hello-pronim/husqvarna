<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ManageController extends Controller
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
    public function user_list()
    {
        
    	$users = User::all();

        $data = array('users' => $users);

        return view('manage.user_list')->with($data);;
    }

    public function csv_import()
    {

        return view('manage.csv_import');
    }
}
