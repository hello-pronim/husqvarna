<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DirectOrder extends Model
{
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_number' , 'order_status', 'store_code', 'order_confirm_date', 'delivery_deadline', 'delivery_method', 'delivery_method_code', 'delivery_name', 'delivery_address1', 'delivery_address2', 'delivery_address3', 'delivery_city', 'delivery_prefecture', 'delivery_postal_code', 'delivery_country', 'phone_number', 'is_gift'
        	, 'purchase_price', 'sku', 'asin', 'product_name', 'product_quantity', 'gift_message', 'invoice_number', 'delivery_date', 'cash_delivery', 'payment_balance', 'care', 'billing_name', 'delivery_quantity'
    ];

    public static function insertData($data)
    {
        $value = DB::table('direct_orders')->where('order_number', $data['order_number'])->get();
        if ($value->count() == 0) {
            DB::table('direct_orders')->insert($data);
        }
    }

    public static function getDataFilter($filter)
    {
        $data = [];           
        $query = DB::table('direct_orders');

        $totals = count($query->get());

        $total_filtered = $totals;

        if((isset($filter['start_date_val'])&& $filter['start_date_val']!='')&&(isset($filter['end_date_val'])&& $filter['end_date_val']!='')){
            $filter_date = $query->where("order_confirm_date", ">=", date_format(date_create($filter['start_date_val']), 'Y/m/d'))
                    ->where("order_confirm_date", "<=", date_format(date_create($filter['end_date_val']), 'Y/m/d'))
                    ->get();

            $total_filtered = count($filter_date);
        }

        if($filter["search"]["value"]){
            $filter_res = $query->Where("po", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("order_number", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("order_status", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("store_code", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("order_confirm_date", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("delivery_deadline", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("delivery_method", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("delivery_method_code", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("delivery_name", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("delivery_address1", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("delivery_city", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("delivery_prefecture", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("delivery_postal_code", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("delivery_country", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("phone_number", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("sku", "like", "%".$filter["search"]["value"]."%")               
            ->orWhere("asin", "like", "%".$filter["search"]["value"]."%")               
            ->orWhere("product_name", "like", "%".$filter["search"]["value"]."%")       
            ->orWhere("billing_name", "like", "%".$filter["search"]["value"]."%")
            ->get();

            $total_filtered = count($filter_res);    
        }

        if($filter['order'][0]["column"]>0){
            switch ($filter['order'][0]["column"]) {
            	case 1:
                    $order_field = "order_number";                
                    break;
            	case 2:
                    $order_field = "order_status";                
                    break;
                case 3:
                    $order_field = "store_code";                
                    break;
                case 4:
                    $order_field = "order_confirm_date";                
                    break;
                case 5:
                    $order_field = "delivery_deadline";                
                    break;
                case 6:
                    $order_field = "delivery_method";                
                    break;        
                case 7:
                    $order_field = "delivery_method_code";                
                    break;
                case 8:
                    $order_field = "delivery_name";                
                    break;
                case 9:
                    $order_field = "delivery_address1";                
                    break;
                case 10:
                    $order_field = "delivery_address2";                
                    break;
                case 11:
                    $order_field = "delivery_address3";                
                    break;                
                case 12:
                    $order_field = "delivery_city";                
                    break;                
                case 13:
                    $order_field = "delivery_prefecture";                
                    break;                
                case 14:
                    $order_field = "delivery_postal_code";                
                    break;                
                case 15:
                    $order_field = "delivery_country";                
                    break;                
                case 16:
                    $order_field = "phone_number";                
                    break;                
                case 17:
                    $order_field = "is_gift";                
                    break;                
                case 18:
                    $order_field = "purchase_price";                
                    break;                                        
                case 19:
                    $order_field = "sku";                
                    break;                
                case 20:
                    $order_field = "asin";                
                    break;                 
                case 21:
                    $order_field = "product_name";                
                    break;                
                case 22:
                    $order_field = "product_quantity";                
                    break;                
                case 23:
                    $order_field = "gift_message";                
                    break;                
                case 24:
                    $order_field = "invoice_number";                
                    break;                
                case 25:
                    $order_field = "delivery_date";                
                    break;                
                case 26:
                    $order_field = "cash_delivery";                
                    break;                                               
                case 27:
                    $order_field = "payment_balance";                
                    break;                
                case 28:
                    $order_field = "care";                
                    break;                
                case 29:
                    $order_field = "billing_name";                
                    break;                
                case 30:
                    $order_field = "delivery_quantity";                
                    break;                                
                default:    
                    $order_field = "order_number";                
            }

            $order_asc = "asc";
            if( $filter['order'][0]["dir"] ){
                $order_asc = $filter['order'][0]["dir"];
            }
            
            $query->orderBy($order_field, $order_asc);
        }
        
        if( $filter['length'] >= 0 ){
            $data_res = $query->offset($filter['start'])->limit($filter['length'])->get();
        
            foreach($data_res as $key=>$value){
                array_push($data, array_values( json_decode(json_encode($value), true)) );
            }
        }else{            
            $data_res = $query->get();

            foreach($data_res as $key=>$value){
                array_push($data, array_values( json_decode(json_encode($value), true)) );
            }
        }

        $result = array('data' => $data, 'recordsFiltered'=> $total_filtered, 'recordsTotal'=>$totals, 'draw'=>$filter['draw']);        

        return $result;
    }
}
