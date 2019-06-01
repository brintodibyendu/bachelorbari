<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoomTypeRoomEligible extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::table('posts', function (Blueprint $table) {
            //
            $table->string('type');
             $table->string('room_no');
              $table->string('max_people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dropColumn('type');
            $table->dropColumn('room_no');
            $table->dropColumn('max_people');
        });
    }
}
