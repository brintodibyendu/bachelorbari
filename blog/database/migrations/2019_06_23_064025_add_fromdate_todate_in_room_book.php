<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFromdateTodateInRoomBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_book', function (Blueprint $table) {
             $table->date('from_date');
              $table->date('to_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_book', function (Blueprint $table) {
            //
             $table->dropColumn('from_date');
            $table->dropColumn('to_date');
        });
    }
}
