<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tbls', function (Blueprint $table) {
            $table->id('Product_id');
            $table->string('Item_name');
            $table->string('Item_dept', 1000);
            $table->string('Item_qty', 100);
            $table->string('Item_qty_type', 50);
            $table->string('Item_category', 50);
            $table->decimal('Item_price', 10,2);
            $table->string('Item_image', 10,2);
            $table->string('Admin_user_id', 10);
            $table->datetime('Item_insert_date');
            $table->boolean('Status')->default(1);
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
        Schema::dropIfExists('product_tbls');
    }
}
