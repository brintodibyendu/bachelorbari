<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoToProductReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            //
             $table->string('owner_rating');
             $table->string('owner_review');
               $table->string('room_rating');
              $table->string('room_review');
             $table->string('room_name');
              $table->string('flat_id');
               $table->string('owner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            //
            $table->dropColumn('owner_rating');
            $table->dropColumn('owner_review');
            $table->dropColumn('room_rating');
            $table->dropColumn('room_review');
            $table->dropColumn('room_name');
              $table->dropColumn('flat_id');
               $table->dropColumn('owner_id');
        });
    }
}
