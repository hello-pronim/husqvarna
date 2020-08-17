<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Product;

class ProductImport implements ToCollection
{
    
   	public $order_id;

    public function  __construct($order_id=0)
    {
        $this->order_id= $order_id;
    }

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {        	
        	if(count($row)>0 && $key >0 ){        		
    			for($j=0; $j< count($row); $j++){
                    switch (trim($rows[0][$j])) {
                        case 'ASIN':
                            $insertData['asin'] = $row[$j];
                            break; 
                        case '製品コード':
                            $insertData['external_id'] = $row[$j];
                            break; 
                        case 'モデル番号':
                            $insertData['mordel_number'] = $row[$j];
                            break;
                        case '商品名':
                            $insertData['title'] = $row[$j];
                            break;
                        case '入荷待ち':
                            $insertData['blockordered'] = $row[$j];
                            break;    
                        case 'ウィンドウの種類':
                            $insertData['window_type'] = $row[$j];
                            break;
                        case '予定日':
                            $insertData['expected_date'] = $row[$j];
                            break;                                        
                        case '依頼数量':
                            $insertData['quantity_request'] = $row[$j];
                            break;
                        case '承認済みの数量':
                            $insertData['accepted_quantity'] = $row[$j];
                            break;    
                        case '受領済みの数量':
                            $insertData['quantity_received'] = $row[$j];
                            break;
                        case '未処理の数量':
                            $insertData['quantity_outstand'] = $row[$j];
                            break;
                        case '仕入価格':
                            $insertData['unit_cost'] = $row[$j];
                            break;
                        case '総額':
                            $insertData['total_cost'] = $row[$j];
                            break;                                           
                        default:
                            $insertData['asin'] = $row[0];
                            break;
                    }
                    $insertData['order_id'] = $this->order_id;
                    $insertData['created_at'] = date("Y-m-d H:i:s");   
                    $insertData['updated_at'] = date("Y-m-d H:i:s");   
                } 
                
        		Product::insertAPIData($insertData);	        	        	
        	
        	}
        }
    }
}
