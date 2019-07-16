<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class room_book extends Model
{
    //
    protected $table='room_book';
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
