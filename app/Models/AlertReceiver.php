<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class AlertReceiver extends Model
{
    protected $table = 'alert_receivers';
	protected $primaryKey = 'id';  
	protected $fillable = [ 'id', 'api_id' , 'receiver', 'type' ];
}
