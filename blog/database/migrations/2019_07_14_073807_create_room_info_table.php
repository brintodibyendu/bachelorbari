<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rpname');
             $table->string('max_people');
             $table->string('cost');
              $table->date('from_date');
              $table->date('to_date');
              $table->string('flat_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_info');
    }
}
