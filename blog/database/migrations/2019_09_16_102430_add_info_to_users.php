<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('owner_rate');
            $table->string('owner_avg_rate');
            $table->string('user_rate');
            $table->string('user_avg_rate');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('owner_rate');
            $table->dropColumn('owner_avg_rate');
            $table->dropColumn('user_rate');
            $table->dropColumn('user_avg_rate');
           

        });
    }
}
