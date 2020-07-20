<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwsCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aws_customers', function (Blueprint $table) {
            $table->id();            
            $table->string('company_type');     
            $table->string('vendor_code')->nullable();
            $table->string('css_customer_code')->nullable();
            $table->string('shipping_code')->nullable();
            $table->string('css_shipping_code')->nullable();            

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
        Schema::dropIfExists('aws_customers');
    }
}
