<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Enums\UserType;
use App\Models\Order;
use App\Models\Product;

class ApiManageController extends Controller
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

    public function index(Request $request){
        if( Auth::user()->user_type <= UserType::Admin ){
            $data = array();
            return view('api.index', compact($data));            
        }
    }
    public function ajax_get_apis(Request $request){
        $apis = array(
                    array('on', 'on', 'sms', array('09083466576'), 'Amazon Vendor Central PO Collector'),
                    array('on', 'on', 'eml', array('support@jts.ec'), 'Amazon Vendor Central - Direct Order Collector'),
                    array('on', 'on', 'eml', array('support@jts.ec'), 'CSS SQL Reader'),
                    array('check', 'on', 'eml', array('support@jts.ec'), 'CSS SQL Writer'),
                    array('on', 'on', 'tel', array('0369121677'), 'Amazon Vendor Central Tracking Poster'),
                    array('down', 'on', 'tel', array('0369121677', '09083466576', '0425555556'), 'Amazon Vendor Central Tracking Direct Order Poster')
                );
        $result = array();
        $searchText = "";
        if($request->input()['search']['value']) $searchText = $request->input()['search']['value'];
        if($searchText){
            foreach ($apis as $key => $api) {
                if(strpos($api[4], $searchText)!==false)
                    array_push($result, $api);
            }
        }else $result = $apis;
        $response = array(
            'data' => $result,
            'draw' => $request->input()['draw'],
            'recordsFiltered' => count($result),
            'recordsTotal' => count($apis)
        );
        
        return response()->json($response);
    }
}