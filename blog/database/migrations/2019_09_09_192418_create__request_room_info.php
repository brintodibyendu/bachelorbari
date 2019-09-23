<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestRoomInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_room_info', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->string('rpname');
             $table->string('max_people');
               $table->string('cost');
              $table->string('from_date');
             $table->string('to_date');
              $table->string('flat_name');
               $table->string('user_id');
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
        Schema::dropIfExists('request_room_info');
    }
}
