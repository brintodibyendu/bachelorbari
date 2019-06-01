<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoomLocationBasisCostFromTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->string('location');
             $table->string('cost_basis');
              $table->string('cost');
              $table->date('from_date');
              $table->date('to_date');
              $table->string('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {  
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dropColumn('location');
            $table->dropColumn('cost_basis');
            $table->dropColumn('cost');
            $table->dropColumn('form_date');
            $table->dropColumn('to_date');
            $table->dropColumn('contact');
        });
    }
}
