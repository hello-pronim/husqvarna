<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Order;

class OrderTrackingImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        
        foreach ($rows as $key => $row) {
        	if(count($row)>0){        		
        		for($i=0; $i<count($row); $i++){        			
        			if(strlen($row[$i]) == 8 && (strlen($row[2])>12&&strlen($row[2])<18)){        				
	        			$data = [$row[$i], $row[2]];
	        			
	        			Order::insertTracking($data);
	        		}
        		}        		        		
        	}
        }        

    }
}
