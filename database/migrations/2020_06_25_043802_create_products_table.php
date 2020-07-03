<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();            
            $table->integer('order_id');     
            $table->string('asin')->nullable();
            $table->string('external_id')->nullable();
            $table->string('mordel_number')->nullable();
            $table->string('title')->nullable();
            $table->float('stock')->nullable();
            $table->string('blockordered')->nullable();
            $table->string('window_type')->nullable();
            $table->string('expected_date')->nullable();
            $table->integer('quantity_request')->nullable();
            $table->integer('accepted_quantity')->nullable();
            $table->integer('quantity_received')->nullable();
            $table->integer('quantity_outstand')->nullable();
            $table->float('unit_cost')->nullable();
            $table->float('total_cost')->nullable();            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
