<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_id', 'asin', 'external_id', 'mordel_number', 'title', 'blockordered', 'window_type', 'expected_date', 'quantity_request', 'accepted_quantity', 'quantity_received', 'quantity_outstand', 'unit_cost', 'total_cost', 'tracking_no'];

    public static function insertData($data)
    {
        $value = DB::table('products')->where('asin', $data['asin'])->where('order_id', $data['order_id'])->get();
        if ($value->count() > 0) {
            DB::table('products')->where('asin', $data['asin'])->where('order_id', $data['order_id'])->update($data);
        }else{
            DB::table('products')->insert($data);
        }        
    }   

    public static function getProductInfo($order_id)
    {
    	$query = Product::with("productTracking")
    	 		->where('order_id', $order_id)
    	 		->get();

    	return $query; 		
    }

    public function productTracking(){
        return $this->hasOne('App\Models\ProductTracking', 'id', 'product_id');
    }

    public function order(){
        return $this->hasMany('App\Models\Order', 'id', 'order_id');
    }    

}
