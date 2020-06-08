<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'scraping_status' , 'delivery_status', 'po', 'vendor', 'ordered_on', 'ship_location', 'window_type', 'window_start', 'window_end', 'total_cases', 'total_cost', 'tracking_no'
    ];

    public static function insertData($data)
    {
        $value = DB::table('orders')->where('po', $data['po'])->get();
        if ($value->count() == 0) {
            DB::table('orders')->insert($data);
        }else{
            DB::table('orders')->update($data)->where('po', $data['po']);
        }
    }

     public static function getDataFilter($filter)
    {
        $data = [];           
        $query = DB::table('orders');

        $totals = count($query->get());

        $total_filtered = $totals;

        if((isset($filter['start_date_val'])&& $filter['start_date_val']!='')&&(isset($filter['end_date_val'])&& $filter['end_date_val']!='')){
            $filter_date = $query->where("ordered_on", ">=", date_format(date_create($filter['start_date_val']), 'Y/m/d'))
                    ->where("ordered_on", "<=", date_format(date_create($filter['end_date_val']), 'Y/m/d'))
                    ->get();

            $total_filtered = count($filter_date);
        }

        if(isset($filter['trader_type'])){
            $tfilter_val = "";

            if($filter['trader_type'] == 'husqvarna'){
                $tfilter_val = "2U%";
            }else if($filter['trader_type'] == 'gardena'){
                $tfilter_val = "WP%";
            }
            $filter_trader = $query->where("vendor", "like", $tfilter_val)->get();

            $total_filtered = count($filter_trader);
        }

        if($filter["search"]["value"]){
            $search_val = $filter["search"]["value"];

            $filter_res = $query->where(function($q) use($search_val) {
      
                            $q->Where("po", "like", "%".$search_val."%")
                                ->orWhere("vendor", "like", "%".$search_val."%")
                                ->orWhere("ship_location", "like", "%".$search_val."%")
                                ->orWhere("window_type", "like", "%".$search_val."%")
                                ->orWhere("ordered_on", "like", "%".$search_val."%")
                                ->orWhere("window_type", "like", "%".$search_val."%")   
                                ->orWhere("window_start", "like", "%".$search_val."%")   
                                ->orWhere("window_end", "like", "%".$search_val."%")   
                                ->orWhere("total_cases", "like", "%".$search_val."%")   
                                ->orWhere("total_cost", "like", "%".$search_val."%");

                          })->get();

            $total_filtered = count($filter_res);    
        }

        if($filter['order'][0]["column"]>0){
            switch ($filter['order'][0]["column"]) {
                case 3:
                    $order_field = "po";                
                    break;
                case 4:
                    $order_field = "vendor";                
                    break;
                case 5:
                    $order_field = "ordered_on";                
                    break;
                case 6:
                    $order_field = "ship_location";                
                    break;        
                case 7:
                    $order_field = "window_type";                
                    break;
                case 8:
                    $order_field = "window_start";                
                    break;
                case 9:
                    $order_field = "window_end";                
                    break;
                case 10:
                    $order_field = "total_cases";                
                    break;
                case 11:
                    $order_field = "total_cost";                
                    break;                
                case 12:
                    $order_field = "tracking_no";                
                    break;                
                default:    
                    $order_field = "ordered_on";                
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
