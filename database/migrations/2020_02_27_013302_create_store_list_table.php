<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Scode');
            $table->string('StoreName');
            $table->string('Dorm');
            $table->string('Area');
            $table->string('StoreStatus');
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
        Schema::dropIfExists('store_list');
    }
}
