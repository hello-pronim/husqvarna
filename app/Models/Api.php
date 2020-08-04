<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $table = 'apis';
	protected $primaryKey = 'id';  
	protected $fillable = [ 'id', 'api_name' , 'via', 'status', 'alert' ];
}
