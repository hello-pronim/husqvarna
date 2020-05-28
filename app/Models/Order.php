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
        }
    }

     public static function getDataFilter($filter)
    {
        $data = [];           
        $query = DB::table('orders');

        $totals = count($query->get());

        $total_filtered = $totals;

        if($filter["search"]["value"]){
            $filter_res = $query->Where("po", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("po", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("vendor", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("ship_location", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("window_type", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("ordered_on", "like", "%".$filter["search"]["value"]."%")
            ->orWhere("window_type", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("window_start", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("window_end", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("total_cases", "like", "%".$filter["search"]["value"]."%")   
            ->orWhere("total_cost", "like", "%".$filter["search"]["value"]."%")   
            ->get();

            $total_filtered = count($filter_res);    
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
