<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_tbls', function (Blueprint $table) {
            $table->id('Order_id');
            $table->string('user_id', 10);
            $table->string('payment_method', 50);
            $table->decimal('subtotal_price', 10,2);
            $table->decimal('dilivery_fee', 10,2);
            $table->decimal('discount', 10,2);
            $table->decimal('total_price', 10,2);
            $table->string('promotion_code', 50);
            $table->string('customer_name', 100);
            $table->string('customer_contact_no', 12);
            $table->string('dilivery_address', 255);
            $table->string('dilivery_city', 100);
            $table->string('dilivery_zip_code', 20);
            $table->string('order_datetime');
            $table->string('admin_remark')->default(' ');
            $table->string('order_status', 20);
            $table->boolean('remove_status')->default(0);
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
        Schema::dropIfExists('order_tbls');
    }
}
