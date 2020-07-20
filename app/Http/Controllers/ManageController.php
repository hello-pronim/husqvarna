<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Enums\UserType;
use App\Http\Controllers\ApiController;
use App\Imports\AwsCustomerList;

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

    public function po_csv_import()
    {

        return view('manage.csv_import');
    }

    public function po_tracking_import()
    {
        return view('manage.tracking_import');
    }

    public function direct_csv_import()
    {

        return view('manage.direct_csv_import');
    }

    public function aws_customer_csv_import()
    {
        return view('manage.aws_customer_list');
    }
    
    public function change_usertype(Request $request)
    {
        
        $response = array();  

        if( $request->input('user_type') ){
            try{
                User::where('id', $request->input('user_id'))->update(array( "user_type" => $request->input('user_type') ));

                $response = array('success' => true , 'msg' => $request->input('user_type'));   
            } catch (Exception $e) {
                $response = array('success' => false , 'msg' => $e);                   
            }        

        }
        return response()->json($response);
    }

    public function user_info(Request $request)
    {
        
        $response = array();  

        if( $request->input('user_id') ){
            try{
                $user = User::where('id', $request->input('user_id'))->get();

                $response = array('success' => true, 'user' => $user);   
            } catch (Exception $e) {
                $response = array('success' => false);                   
            }        

        }
        return response()->json($response);
    }

    public function user_edit(Request $request)
    {
        
        $response = array();  

        if( $request->input('user_id') ){
            try{
                $data = array(
                            'email' => $request->input('email'), 
                            'username' => $request->input('username'), 
                            'first_name' => $request->input('first_name'), 
                            'last_name' => $request->input('last_name'), 
                            'phone' => $request->input('phone'), 
                            'position' => $request->input('position'), 
                            'company' => $request->input('company'),
                            'user_type' => $request->input('user_type') 
                        );

                $user = User::where('id', $request->input('user_id'))->update($data);

                $response = array('success' => true);   
            } catch (Exception $e) {
                $response = array('success' => false);                   
            }        

        }
        return response()->json($response);
    }

    public function delete_user(Request $request)
    {
        
        $response = array();  

        if( $request->input('user_id') ){
            try{
                User::where('id', $request->input('user_id'))->delete();

                $response = array('success' => true);   
            } catch (Exception $e) {
                $response = array('success' => false);                   
            }        

        }
        return response()->json($response);
    }

    /*IMPORT AWS Customer LIST*/
    public function awsCustomerCSV(Request $request)
    {   
        return response()->json( ApiController::readcsv($request, new AwsCustomerList(), 'aws_customer') );

    }
}
