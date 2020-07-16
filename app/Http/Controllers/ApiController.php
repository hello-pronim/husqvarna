<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use App\Imports\OrderImport;
use App\Imports\ProductImport;
use Excel;

class ApiController extends Controller
{
    public function uploadOrder(Request $request){   
                
        return response()->json( $this->readcsv($request, new OrderImport($request->input('status')), 'po_csv') );        

    }

    public function uploadProduct(Request $request){       	
        
        return response()->json( $this->readcsv($request, new ProductImport($request->input('order_id')), 'po_detail') );

    }

    public function updatePoStatus(Request $request){       	        

        return response()->json( Order::updateStatus($request->input('order_id'), $request->input('status')) );

    }

    private function readcsv($request, $import, $upload_path){
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
                     	$location = public_path('uploads/'.$upload_path);

                        $filepath = $location . "/" . $filename;

                        if(file_exists($filepath)) unlink($filepath);
                        // Upload file
                        $file->move($location, $filename);
                        
                        Excel::import($import, $filepath); 

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
        return $result;
    }

}
