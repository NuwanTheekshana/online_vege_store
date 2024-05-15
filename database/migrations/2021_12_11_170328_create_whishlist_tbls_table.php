<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhishlistTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whishlist_tbls', function (Blueprint $table) {
            $table->id('whishlist_id');
            $table->string('product_id', 10);
            $table->string('quntity', 10)->default(1);
            $table->string('user_id', 10);
            $table->datetime('date_time');
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
        Schema::dropIfExists('whishlist_tbls');
    }
}
