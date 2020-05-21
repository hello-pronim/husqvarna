<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Order;

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
        $orders = Order::get();        

        $data = array('orders');
        return view('dashboard.index', compact($data));        
    }

    public function uploadCSV(Request $request)
    {        
        
        //if ($request->input('submit') != null) {

            $file = $request->file('po_csv');

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

                    // Upload file
                    $file->move($location, $filename);

                    // Import CSV to Database
                    $filepath = $location . "/" . $filename;

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
                            "ordered_on"   => $importData[2],
                            "ship_location"    => $importData[3],
                            "window_type"    => $importData[4],
                            "window_start"    => $importData[5],
                            "window_end"    => $importData[6],
                            "total_cases"    => $importData[7],
                            "total_cost"    => $importData[8],
                        );

                        Order::insertData($insertData);

                    }

                    Session::flash('message', 'Import Successful.');
                } else {
                    Session::flash('message', 'File too large. File must be less than 2MB.');
                }

            } else {
                Session::flash('message', 'Invalid File Extension.');
            }

        //}

        // Redirect to index
        return redirect(route('dashboard'));
    }

}
