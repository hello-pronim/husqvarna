<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use KubAT\PhpSimple\HtmlDomParser;

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
        
        if ($value->count() > 0) {
            DB::table('orders')->where('po', $data['po'])->update($data);
        }else{
            DB::table('orders')->insert($data);
        }        
    }

    public static function insertTracking($data)
    {
        $value = DB::table('orders')->where('po', $data[0])->first();
        if($value){
            if($value->tracking_no){
                $tracking_no = explode(',', $this->clean($value->tracking_no));
                if(in_array( $this->clean($data[1]), $tracking_no )){
                    if(count($tracking_no) >0){
                        DB::table('orders')->where('po', $data[0])->update(array('tracking_no'=> $value->tracking_no .','.$data[1] ));
                    }else{
                        DB::table('orders')->where('po', $data[0])->update(array('tracking_no'=> $data[1] ));
                    }            
                }                
            }else{
                DB::table('orders')->where('po', $data[0])->update(array('tracking_no'=> $data[1] ));
            }
            
        }        
    }

    function clean($string) {
       //$string = str_replace(' ', '-', $string); 

       return preg_replace('/[^0-9\-,]/', '', $string); 
    }

    public static function change_date_format(){
        $query = DB::table('orders')->get();

        foreach ($query as $key => $value) {
            $data = array(               
                "ordered_on"   => date('Y/m/d', strtotime($value->ordered_on)),               
                "window_start"    => date('Y/m/d', strtotime($value->window_start)),
                "window_end"    => date('Y/m/d', strtotime($value->window_end))
            );

            DB::table('orders')->where('id', $value->id)->update($data);

        }

        echo "Ok";
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

        $count = 0;
        $temp_key=0;
        $tracking_data = "";
        foreach ($data as $key => $order) {
            
            if($order[12]){
                $order_tracking = explode(",", $order[12]);
                if($order[12]!=""){
                    foreach ($order_tracking as $k => $ot) {
                        $count ++;
                        $tracking_data .= "&main:no".($count)."=".$ot;    
                    }                
                }                
            }           

            if(($count%10==0 || $key>=(count($data)-1)) && $count>0 ){               
                $res = array();

                if($tracking_data != ""){                    
                    $curl = curl_init();

                    $query = "jsf_tree_64=".urlencode( env("SAGAWA_JSF_TREE_64", "") )."&jsf_state_64=".urlencode( env("SAGAWA_JSF_STATE_64", "") ) . "&jsf_viewid=".urlencode('/web/okurijosearcheng.jsp')."&main:correlation=1&main:toiStart=".urlencode('Track it')."&main_SUBMIT=1" . $tracking_data;    
                    
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://k2k.sagawa-exp.co.jp/p/sagawa/web/okurijosearcheng.jsp",            
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_POSTFIELDS => $query,
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                            'Content-Length: ' . strlen( $query )        
                        ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);                     
                    if($response){ 
                        $dom = HtmlDomParser::str_get_html( $response );
                        $tracking_data ="";

                        for ($i=1; $i <=10 ; $i++) { 
                            $tracking_no = $dom->find("input[name='main:no".$i."']");
                            $tracking_date = $dom->find("input[name='main:h-date".$i."']");
                            $tracking_status = $dom->find("input[name='main:h-status".$i."']");    
                            $res[] = [$tracking_no[0]->value, $tracking_date[0]->value,  $tracking_status[0]->value];
                        }  

                        $q=0;

                        for($j=$temp_key; $j<=$key; $j++){
                            $q_data = explode(',', $data[$j][12]);
                            
                            if($data[$j][12]){
                                foreach ($q_data as $v => $qv) {
                                    $data[$j][2][]=$res[$q];
                                    $q++;
                                }    
                            }
                        }    
                    }           
                    

                    $temp_key= $key+1;  
                }   
            }                              

        }

        $result = array('data' => $data, 'recordsFiltered'=> $total_filtered, 'recordsTotal'=>$totals, 'draw'=>$filter['draw']);        

        return $result;
    }

    // public static function get_tracking_status($orders){

    //     $result = array();

    //     $tracking_data = "";
    //     foreach ($orders as $key => $order) {
    //         if($order->tracking_no){                
    //             $tracking_data .= "&main:no".($key+1)."=".$order->tracking_no;
    //         }else{
    //             $tracking_data .= "&main:no".($key+1)."=000000000000";
    //         }           
    //     }

    //     if($tracking_data != ""){
    //         $curl = curl_init();

    //         $query = "jsf_tree_64=".urlencode( env("SAGAWA_JSF_TREE_64", "") )."&jsf_state_64=".urlencode( env("SAGAWA_JSF_STATE_64", "") ) . "&jsf_viewid=".urlencode('/web/okurijosearcheng.jsp')."&main:correlation=1&main:toiStart=".urlencode('Track it')."&main_SUBMIT=1" . $tracking_data;    
            
    //         curl_setopt_array($curl, array(
    //             CURLOPT_URL => "https://k2k.sagawa-exp.co.jp/p/sagawa/web/okurijosearcheng.jsp",            
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => "",
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 0,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => "POST",
    //             CURLOPT_POSTFIELDS => $query,
    //             CURLOPT_HTTPHEADER => array(
    //                 "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
    //                 'Content-Length: ' . strlen( $query )        
    //             ),
    //         ));

    //         $response = curl_exec($curl);

    //         curl_close($curl);            
    //         $dom = HtmlDomParser::str_get_html( $response );
            
    //          for ($i=1; $i <=10 ; $i++) { 
    //             $tracking_date = $dom->find("input[name='main:h-date".$i."']");
    //             $tracking_status = $dom->find("input[name='main:h-status".$i."']");    
    //             $result[] = [$tracking_date[0]->value,  $tracking_status[0]->value];
    //         }        
    //     }        
             
    //     var_dump($result);     
    //     exit;
    // }

    public static function get_tracking_status($tracking_no){

        $result = array();

        $tracking_data = "&main:no1=".$tracking_no;

        if($tracking_data != ""){
            $curl = curl_init();

            $query = "jsf_tree_64=".urlencode( env("SAGAWA_JSF_TREE_64", "") )."&jsf_state_64=".urlencode( env("SAGAWA_JSF_STATE_64", "") ) . "&jsf_viewid=".urlencode('/web/okurijosearcheng.jsp')."&main:correlation=1&main:toiStart=".urlencode('Track it')."&main_SUBMIT=1" . $tracking_data;    
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://k2k.sagawa-exp.co.jp/p/sagawa/web/okurijosearcheng.jsp",            
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $query,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    'Content-Length: ' . strlen( $query )        
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);            
            $dom = HtmlDomParser::str_get_html( $response );
            
            $tracking_date = $dom->find("input[name='main:h-date1]");
            $tracking_status = $dom->find("input[name='main:h-status1]");    
            echo $tracking_date[0]->value;
            echo "-";
            echo $tracking_status[0]->value;
            echo "|";
            exit;
        }
    }
}
