<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoomInfoRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
          //
         Schema::table('room_info', function (Blueprint $table) {
            //
            $table->string('booking');
            $table->string('requested_from_date');
            $table->string('requested_to_date');
             $table->string('hostid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('room_info', function (Blueprint $table) {
            //
            $table->dropColumn('booking');
            $table->dropColumn('requested_from_date');
            $table->dropColumn('requested_to_date');
            $table->dropColumn('hostid');
        });
    }
}
