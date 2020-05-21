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
        'id', 'po', 'vendor', 'ordered_on', 'ship_location', 'window_type', 'window_start', 'window_end', 'total_cases', 'total_cost',
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
        $query = DB::table('orders')->where("po", "like", "%".$filter["search"]["value"]."%")->get();

        if( $filter['length'] > 0 ){
            $query->offset($filter['start'])->limit($filter['length']);
        }

        $result = $query->get();
        
        return $result;
    }
}