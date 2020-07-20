<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class AwsCustomer extends Model
{
    public static function insertData($data)
    {
        $value = DB::table('aws_customers')->where('company_type', $data['company_type'])->where('vendor_code', $data['vendor_code'])->where('shipping_code', $data['shipping_code'])->get();
        if ($value->count() > 0) {
            DB::table('aws_customers')->where('company_type', $data['company_type'])->where('vendor_code', $data['vendor_code'])->where('shipping_code', $data['shipping_code'])->update($data);
        }else{
            DB::table('aws_customers')->insert($data);
        }        
    }   
}
