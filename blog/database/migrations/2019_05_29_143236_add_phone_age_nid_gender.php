<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneAgeNidGender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('users', function (Blueprint $table) {
            //
            $table->string('Phone_number');
            $table->integer('Age');
            $table->string('NID');
            $table->string('Gender');
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
            $table->dropColumn('phone_number');
            $table->dropColumn('Age');
            $table->dropColumn('NID');
            $table->dropColumn('Gender');
        });
    }
}
