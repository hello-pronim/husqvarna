<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;
use App\Models\Order;
use App\Models\Product;
use App\Models\DirectOrder;
use App\Models\ProductTracking;
use App\Models\AwsCustomer;
use App\Enums\UserType;
use App\Imports\OrderImport;
use App\Imports\OrderTrackingImport;
use Excel;
use PDF;

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

    public function po_detail_pdf(Request $request){                
        $order_id = $request->id;
        $order = Order::where('id', $order_id)->get()->first();
        $warehouse_code = trim(explode('-', $order->ship_location)[0] );
        $orders = Order::join('products', 'orders.id', '=', 'products.order_id')->where('orders.id', $order_id)->get();
        $aws_code = AwsCustomer::where('vendor_code', $order->vendor)
                                ->where('shipping_code', $warehouse_code)
                                ->first();
        $limit_per_page = 9;
        $page_count = ceil(count($orders)/(float)$limit_per_page);
        $data = array('orders', 'limit_per_page', 'page_count', 'aws_code');

        if($page_count >0){
            $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])
                        ->loadView('dashboard.order_detail_pdf', compact($data))
                        ->setOptions(['defaultFont'=>'mgenplus'])
                        ->setPaper('a4', 'landscape');            
            $po_number = $order->po;
            
            return $pdf->download($warehouse_code ."_".$po_number.'.pdf');
        }

        // return redirect(route("dashboard"));

        return view('dashboard.order_detail_pdf', compact($data));
    }

    public function ajax_esker_email(Request $request){
        $order_id = $request->input('order_id');
        if($order_id){
            $products = Product::getProductInfo($order_id);
            if(count($products) > 0){
                $order = Order::where('id', $order_id)->get()->first();
                $warehouse_code = trim(explode('-', $order->ship_location)[0] );
                $orders = Order::join('products', 'orders.id', '=', 'products.order_id')->where('orders.id', $order_id)->get();
                $aws_code = AwsCustomer::where('vendor_code', $order->vendor)
                                        ->where('shipping_code', $warehouse_code)
                                        ->first();
                $limit_per_page = 9;
                $page_count = ceil(count($orders)/(float)$limit_per_page);
                $data = array('orders', 'limit_per_page', 'page_count', 'aws_code');

                if($page_count >0){
                    $pdf = PDF::setOptions(['defaultFont' => 'dejavu serif'])
                                ->loadView('dashboard.order_detail_pdf', compact($data))
                                ->setOptions(['defaultFont'=>'mgenplus'])
                                ->setPaper('a4', 'landscape');            
                    $po_number = $order->po;
                    
                    $filepath = public_path('uploads/esker_pdf/') . $warehouse_code ."_".$po_number.'.pdf';
                    $pdf->save( $filepath );

                    $param = array("subject" => "Esker PDF");
                    $attach = array("name" => $warehouse_code ."_".$po_number.'.pdf',
                                        "path" => $filepath,
                                        "mime" => 'application/pdf'
                                    );
                    $this->sendEmail("esker_pdf", $param, $attach);

                    $response = array('success' => true , 'msg' => 'メールが送信されました。' );
                }else{
                    $response = array('success' => false , 'msg' => '注文の詳細を挿入してください。' );                   
                }  

            }else{
                $response = array('success' => false , 'msg' => '注文の詳細を挿入してください。' );                   
            }
        }else{
            $response = array('success' => false , 'msg' => '注文IDが必要です。' );   
        }          

        return response()->json($response);                    
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
                    if($order->total_cases > 0){
                        $order->tracking_no = $request->input('tracking_no');

                        ProductTracking::autoinsertData($request->input('tracking_no'), $request->input('order_id'));
                        $order->save();
                        $response = array('success' => true , 'msg' => 'お問合せ番号が追加されました。' );
                    }else{
                        $response = array('success'=>false, 'msg'=>'お問合せ番号を追加することができません');
                    }
                }else{
                    if($order->total_cases > count(explode(',', $order->tracking_no))){
                        $order->tracking_no = $request->input('tracking_no') .",".$order->tracking_no ;
                        $order->save();
                        $response = array('success' => true , 'msg' => 'お問合せ番号が追加されました。' );
                    }else{
                        $response = array('success' => false, 'msg'=>'もうお問合せ番号を追加することができません');
                    }
                } 
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
            $response = array(
                            'products' => $products,
                            'tracking_number' => Order::find($request->input('order_id'))->tracking_no                    
                        );                   
        }else{
            $response = array('success' => false , 'msg' => '注文IDが必要です。' );   
        }                       
        
        return response()->json($response);
    }

    public function ajax_product_tracking(Request $request)
    { 
        if($request->input('product_id')){           

            ProductTracking::insertData($request->input());

            $response = array('success' => true, '更新成功');   
        }else{
            $response = array('success' => false, '失敗した');    
        }    

        return response()->json($response);
    }

    public function change_date_format(Request $request)
    { 
        Order::change_date_format();
    }

    /*IMPORT PO LIST*/
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

                        Excel::import(new OrderImport, $filepath); 

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

    /*IMPORT TRACKING LIST*/
    public function uploadTrackingCSV(Request $request)
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
                $valid_extension = array("csv", "xls","xlsx");

                // 2MB in Bytes
                $maxFileSize = 2097152;

                // Check file extension
                if (in_array(strtolower($extension), $valid_extension)) {

                    // Check file size
                    if ($fileSize <= $maxFileSize) {

                        // File upload location
                        $location = public_path('uploads/po_tracking');

                        $filepath = $location . "/" . $filename;

                        if(file_exists($filepath)) unlink($filepath);
                        // Upload file
                        $file->move($location, $filename);

                        Excel::import(new OrderTrackingImport, $filepath);                       
                       
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

    /*IMPORT PO DETAILS*/
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
                        $import_title = array();
                        $insertData = array();

                        while($raw_row = fgets($file)) { // fgets is actually binary safe
                            $row = explode(",", $raw_row);
                            $num = count($row);
                            $i++;
                            $insertData = array();
                            if($i==1) $import_title = $row;
                            else {
                                for($j=0; $j< $num; $j++){
                                    switch (trim($import_title[$j])) {
                                        case '"ASIN"':
                                            $insertData['asin'] = str_replace('"', '', $row[$j]);
                                            break; 
                                        case '"製品コード"':
                                            $insertData['external_id'] = str_replace('"', '', $row[$j]);
                                            break; 
                                        case '"モデル番号"':
                                            $insertData['mordel_number'] = str_replace('"', '', $row[$j]);
                                            break;
                                        case '"商品名"':
                                            $insertData['title'] = str_replace('"', '', $row[$j]);
                                            break;
                                        case '"入荷待ち"':
                                            $insertData['blockordered'] = str_replace('"', '', $row[$j]);
                                            break;    
                                        case '"ウィンドウの種類"':
                                            $insertData['window_type'] = str_replace('"', '', $row[$j]);
                                            break;
                                        case '"予定日"':
                                            $insertData['expected_date'] = str_replace('"', '', $row[$j]);
                                            break;                                        
                                        case '"依頼数量"':
                                            $insertData['quantity_request'] = str_replace('"', '', $row[$j]);
                                            break;
                                        case '"承認済みの数量"':
                                            $insertData['accepted_quantity'] = str_replace('"', '', $row[$j]);
                                            break;    
                                        case '"受領済みの数量"':
                                            $insertData['quantity_received'] = str_replace('"', '', $row[$j]);
                                            break;
                                        case '"未処理の数量"':
                                            $insertData['quantity_outstand'] = str_replace('"', '', $row[$j]);
                                            break;
                                        case '"仕入価格"':
                                            $insertData['unit_cost'] = str_replace('"', '', $row[$j]);
                                            break;
                                        case '"総額"':
                                            $insertData['total_cost'] = str_replace('"', '', $row[$j]);
                                            break;                                           
                                        default:
                                            $insertData['asin'] = str_replace('"', '', $row[0]);
                                            break;
                                    }
                                    $insertData['order_id'] = $request->input('order_id');
                                    $insertData['created_at'] = date("Y-m-d H:i:s");   
                                    $insertData['updated_at'] = date("Y-m-d H:i:s");   
                                } 
                                Product::insertData($insertData); 
                            }                         
                        }
                        fclose($file);

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
