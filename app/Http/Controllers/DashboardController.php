<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;
use App\Models\Order;
use App\Models\Product;
use App\Models\DirectOrder;
use App\Models\ProductTracking;
use App\Enums\UserType;


class DashboardController extends Controller
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
        if( Auth::user()->user_type <= UserType::Admin ){
            $orders = Order::limit(10)->get();

            //Order::get_tracking_status($orders);

            $data = array();
            return view('dashboard.index', compact($data));            
        }      
        return redirect(route('orders'));  
    }

    public function orders()
    {
        $orders = Order::limit(20)->get();                
        $data = array('orders');

        return view('dashboard.orders', compact($data));        
    }

    public function order_detail($po="")
    {
        if($po){

        }
        $data = array('po');

        return view('dashboard.order_detail', compact($data));        
    }    

    public function ajax_dashbaord(Request $request)
    {
               
        $response = Order::getDataFilter($request->input());
        
        return response()->json($response);
    }

    public function ajax_direct_order(Request $request)
    {
               
        $response = DirectOrder::getDataFilter($request->input());        
        
        return response()->json($response);
    }

    public function ajax_tracking_update(Request $request)
    {
        if($request->input('tracking_no') && $request->input('order_id')){
            try{
                $order = Order::find($request->input('order_id'));

                if($order->tracking_no == "" || $order->tracking_no == null){
                    $order->tracking_no = $request->input('tracking_no');
                }else{
                    $order->tracking_no = $request->input('tracking_no') .",".$order->tracking_no ;
                }
                
                $order->save();

                $response = array('success' => true , 'msg' => 'お問合せ番号が追加されました。' );   
            } catch (Exception $e) {
                $response = array('success' => true , 'msg' => 'お問合せ番号が追加されました。' );                   
            }            
        }else{
            $response = array('success' => false , 'msg' => '空の値を挿入することはできません。' );   
        }                       
        
        return response()->json($response);
    }

    public function ajax_order_products(Request $request)
    {
        if($request->input('order_id')){
            $products = Product::getProductInfo($request->input('order_id'));
            $response = array('success' => true , 'products' => $products );                   
        }else{
            $response = array('success' => false , 'msg' => '注文IDが必要です。' );   
        }                       
        
        return response()->json($response);
    }

    public function ajax_product_tracking(Request $request)
    { 
        if($request->input('product_id')){           

            ProductTracking::insertData($request->input());

            $response = array('success' => true );   
        }else{
            $response = array('success' => false );    
        }    

        return response()->json($response);
    }

    public function change_date_format(Request $request)
    { 
        Order::change_date_format();
    }

    public function uploadCSV(Request $request)
    {        
        
        //if ($request->input('submit') != null) {

            $file = $request->file('file');

            if($file){
                // File Details
                $filename  = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $tempPath  = $file->getRealPath();
                $fileSize  = $file->getSize();
                $mimeType  = $file->getMimeType();

                // Valid File Extensions
                $valid_extension = array("csv");

                // 2MB in Bytes
                $maxFileSize = 2097152;

                // Check file extension
                if (in_array(strtolower($extension), $valid_extension)) {

                    // Check file size
                    if ($fileSize <= $maxFileSize) {

                        // File upload location
                        $location = public_path('uploads/po_csv');

                        $filepath = $location . "/" . $filename;

                        if(file_exists($filepath)) unlink($filepath);
                        // Upload file
                        $file->move($location, $filename);

                        // Reading file
                        $file = fopen($filepath, "r");

                        $importData_arr = array();
                        $i              = 0;

                        while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                            $num = count($filedata);

                            //Skip first row (Remove below comment if you want to skip the first row)
                            if($i == 0){
                                $i++;
                                continue;
                            }
                            for ($c = 0; $c < $num; $c++) {
                                $importData_arr[$i][] = $filedata[$c];
                            }
                            $i++;
                        }
                        fclose($file);

                        // Insert to MySQL database
                        foreach ($importData_arr as $importData) {

                            $insertData = array(
                                "po" => $importData[0],
                                "vendor"     => $importData[1],
                                "ordered_on"   => date('Y/m/d', strtotime($importData[2])),
                                "ship_location"    => $importData[3],
                                "window_type"    => $importData[4],
                                "window_start"    => date('Y/m/d', strtotime($importData[5])),
                                "window_end"    => date('Y/m/d', strtotime($importData[6])),
                                "total_cases"    => $importData[7],
                                "total_cost"    => $importData[8],
                                "created_at" => date("Y-m-d H:i:s"),
                                "updated_at" => date("Y-m-d H:i:s")
                            );

                            Order::insertData($insertData);

                        }

                        //Session::flash('message', 'インポートに成功しました。');
                        $result=array('success' => true, 'msg' =>'インポートに成功しました。' );
                    } else {
                        //Session::flash('message', 'フィアルは大きすぎる。 ファイルは2MB未満でなければなりません。');
                        $result=array('success' => false, 'msg' =>'フィアルは大きすぎる。 ファイルは2MB未満でなければなりません。' );
                    }

                } else {
                    //Session::flash('message', '無効なファイル拡張子。');
                    $result=array('success' => false, 'msg' =>'無効なファイル拡張子。' );
                }
            }else{

                //Session::flash('message', 'ファイルのアップロードに失敗しました。');
                $result=array('success' => false, 'msg' =>'ファイルのアップロードに失敗しました。' );
            }    
        //}

        // Redirect to index
        //return redirect(route('management.csv_import'));
        return response()->json($result);

    }

    public function ajax_import_po_csv(Request $request){

        $file = $request->file("file");
        
        $result=array('success' => true, 'msg' =>$file );

        if($file){
                // File Details
                $filename  = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $tempPath  = $file->getRealPath();
                $fileSize  = $file->getSize();
                $mimeType  = $file->getMimeType();

                // Valid File Extensions
                $valid_extension = array("csv");

                // 2MB in Bytes
                $maxFileSize = 2097152;

                // Check file extension
                if (in_array(strtolower($extension), $valid_extension)) {

                    // Check file size
                    if ($fileSize <= $maxFileSize) {

                        // File upload location
                        $location = public_path('uploads/po_detail');

                        $filepath = $location . "/" . $filename;

                        if(file_exists($filepath)) unlink($filepath);
                        // Upload file
                        $file->move($location, $filename);

                        // Reading file
                        $file = fopen($filepath, "r");

                        $importData_arr = array();
                        $i              = 0;

                        while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                            $num = count($filedata);

                            //Skip first row (Remove below comment if you want to skip the first row)
                            if($i == 0){
                                $i++;
                                continue;
                            }
                            for ($c = 0; $c < $num; $c++) {
                                $importData_arr[$i][] = $filedata[$c];
                            }
                            $i++;
                        }
                        fclose($file);

                        // Insert to MySQL database
                        foreach ($importData_arr as $importData) {

                            $insertData = array(
                                'order_id' => $request->input('order_id'),
                                'asin' => $importData[0],
                                'external_id' => $importData[1],
                                'mordel_number' => $importData[2],
                                'title' => $importData[3],
                                'blockordered' => $importData[4],
                                'window_type' => $importData[5],
                                'expected_date' => $importData[6],
                                'quantity_request' => $importData[7],
                                'accepted_quantity' => $importData[8],
                                'quantity_received' => $importData[9],
                                'quantity_outstand' => $importData[10],
                                'unit_cost' => $importData[11],
                                'total_cost' => $importData[12],
                                "created_at" => date("Y-m-d H:i:s"),
                                "updated_at" => date("Y-m-d H:i:s")
                            );

                            Product::insertData($insertData);

                        }

                        //Session::flash('message', 'インポートに成功しました。');
                        $result=array('success' => true, 'msg' =>'インポートに成功しました。' );
                    } else {
                        //Session::flash('message', 'フィアルは大きすぎる。 ファイルは2MB未満でなければなりません。');
                        $result=array('success' => false, 'msg' =>'フィアルは大きすぎる。 ファイルは2MB未満でなければなりません。' );
                    }

                } else {
                    //Session::flash('message', '無効なファイル拡張子。');
                    $result=array('success' => false, 'msg' =>'無効なファイル拡張子。' );
                }
            }else{

                //Session::flash('message', 'ファイルのアップロードに失敗しました。');
                $result=array('success' => false, 'msg' =>'ファイルのアップロードに失敗しました。' );
            }    

        return response()->json( $result );
    }    

}
