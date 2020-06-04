<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->nullable();
            $table->string('order_status')->nullable();
            $table->string('store_code')->nullable();
            $table->string('order_confirm_date')->nullable();
            $table->string('delivery_deadline')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('delivery_method_code')->nullable();
            $table->string('delivery_name')->nullable();
            $table->string('delivery_address1')->nullable();
            $table->string('delivery_address2')->nullable();
            $table->string('delivery_address3')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_prefecture')->nullable();
            $table->string('delivery_postal_code')->nullable();
            $table->string('delivery_country')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('is_gift')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('sku')->nullable();
            $table->string('asin')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('gift_message')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('cash_delivery')->nullable();
            $table->string('payment_balance')->nullable();
            $table->string('care')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('delivery_quantity')->nullable();

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
        Schema::dropIfExists('direct_orders');
    }
}
