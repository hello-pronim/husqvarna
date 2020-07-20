<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\AwsCustomer;

class AwsCustomerList implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
        	if(count($row)>0 && $key >0 ){        		
    			$data = array(
                    "company_type" => $row[0],
                    "vendor_code" => $row[1],
                    "css_customer_code"  => $row[2],
                    "shipping_code"  => $row[3],
                    "css_shipping_code"  => $row[4],
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s")
                );     
                
        		AwsCustomer::insertData($data);	        	        	
        	}
        }
    }
}
