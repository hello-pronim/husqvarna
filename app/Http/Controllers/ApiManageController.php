<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Enums\UserType;
use App\Models\Order;
use App\Models\Product;
use App\Models\Api;
use App\Models\AlertReceiver;

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
        $apis = array();
        $array = Api::get()->toArray();
        foreach ($array as $key => $api) {
            $elem = array();
            array_push($elem, $api['id']);
            array_push($elem, $api['status']);
            array_push($elem, $api['alert']);
            array_push($elem, $api['via']);

            $receivers = AlertReceiver::where('api_id', $api['id'])->get()->toArray();
            array_push($elem, $receivers);

            array_push($elem, $api['api_name']);
            array_push($apis, $elem);
        }

        $result = array();
        $searchText = "";
        if($request->input()['search']['value']) $searchText = $request->input()['search']['value'];
        if($searchText){
            foreach ($apis as $key => $api) {
                if(strpos($api['5'], $searchText)!==false)
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
    public function updateApiAlert(Request $request){
        $alert = $request->alert;
        $api_id = $request->api_id;
        Api::where('id', $api_id)->update(array('alert'=>$alert));
        $response = array('success' => true , 'msg' => 'APIステータスは正常に更新されました' );

        return response()->json($response);
    }
    public function updateApiVia(Request $request){
        $via = $request->via;
        $api_id = $request->api_id;
        Api::where('id', $api_id)->update(array('via'=>$via));
        $response = array('success' => true , 'msg' => '送信方式が変更されました' );

        return response()->json($response);
    }
    public function addApiReceiver(Request $request){
        $receiver = $request->receiver;
        $api_id = $request->api_id;
        AlertReceiver::create(array(
            'api_id'=>$api_id,
            'receiver'=>$receiver
        ));
        $response = array('success' => true , 'msg' => '送信先へ正常に追加されました' );

        return response()->json($response);
    }
    public function checkApis(){
        $apis = Api::get()->toArray();
    }
}