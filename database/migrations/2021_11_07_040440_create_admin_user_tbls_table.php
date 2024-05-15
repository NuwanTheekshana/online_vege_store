<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUserTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user_tbls', function (Blueprint $table) {
            $table->id('Admin_user_id');
            $table->string('F_name', 50);
            $table->string('L_name', 50);
            $table->string('NIC', 15);
            $table->string('email')->unique();
            $table->string('Contract_No', 12);
            $table->string('Permission', 20);
            $table->string('password');
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
        Schema::dropIfExists('admin_user_tbls');
    }
}
