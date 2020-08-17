<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Order;

class OrderImport implements ToCollection
{
    public $status;

    public function  __construct($status="new")
    {
        $this->status= $status;
    }

    /**
    * @param Collection $row
    */
    public function collection(Collection $rows)
    {        
        foreach ($rows as $key => $row) {
        	if(count($row)>0 && $key >0 ){        		
    			$data = array(
                    "scraping_status" => $this->status,
                    "po" => $row[0],
                    "vendor"     => $row[1],
                    "ordered_on"   => date('Y/m/d', strtotime($row[2])),
                    "ship_location"    => $row[3],
                    "window_type"    => $row[4],
                    "window_start"    => date('Y/m/d', strtotime($row[5])),
                    "window_end"    => date('Y/m/d', strtotime($row[6])),
                    "total_cases"    => $row[7],
                    "total_cost"    => $row[8],
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s")
                );     
                
        		Order::insertData($data);	        	        	
        	}
        }
        
    }
}
