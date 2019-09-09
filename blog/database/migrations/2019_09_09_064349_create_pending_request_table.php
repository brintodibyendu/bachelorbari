<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('room_id');
            $table->string('room_name');
            $table->integer('flat_id');
            $table->string('flat_name');
            $table->string('requested_by');
            $table->string('requested_by_id');
            $table->date('requested_from_date');
            $table->date('requested_to_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pending_request');
    }
}
