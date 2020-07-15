<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('scraping_status')->nullable();
            $table->tinyInteger('delivery_status')->nullable();
            $table->string('po')->nullable();
            $table->string('vendor')->nullable();
            $table->string('ordered_on')->nullable();
            $table->string('ship_location')->nullable();
            $table->string('window_type')->nullable();
            $table->string('window_start')->nullable();
            $table->string('window_end')->nullable();
            $table->integer('total_cases')->nullable();
            $table->integer('total_cost')->nullable();
            $table->string('tracking_no')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
