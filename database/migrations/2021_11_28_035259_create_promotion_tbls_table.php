<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_tbls', function (Blueprint $table) {
            $table->id();
            $table->string('promo_code');
            $table->string('promo_name');
            $table->string('promo_description', 1000);
            $table->string('promo_discount');
            $table->string('promo_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('promo_added_user_id');
            $table->string('promo_added_user_name');
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
        Schema::dropIfExists('promotion_tbls');
    }
}
