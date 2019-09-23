<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestroomadmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestroomadmin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->mediumText('body');
            $table->timestamps();
            $table->integer('user_id');
             $table->string('cover_image');
              $table->string('type');
             $table->string('room_no');
               $table->string('contact');
              $table->string('location');
             $table->string('total_rating');
              $table->string('total_cost');
               $table->string('family');
                $table->string('friends');
                 $table->string('pet_allow');
                  $table->string('student');
                   $table->string('job_seeker');
                    $table->string('late_night');
                     $table->string('hard_drinks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requestroomadmin');
    }
}
