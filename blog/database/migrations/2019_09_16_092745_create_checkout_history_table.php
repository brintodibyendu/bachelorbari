<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckoutHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('room_id');
            $table->string('room_name');
            $table->string('flat_id');
            $table->string('flat_name');
            $table->string('Entry_date');
            $table->string('checkout_date');
            $table->string('user_id');
            $table->string('user_name');
            $table->string('status');
            $table->string('owner_id');
            $table->string('owner_name');
            $table->string('user_rating');
            $table->string('user_review');
            $table->string('request_id');
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
        Schema::dropIfExists('checkout_history');
    }
}
