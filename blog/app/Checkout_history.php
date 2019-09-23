<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout_history extends Model
{
    //
      protected $table='checkout_history';
    public $primaryKey='id';
    public $timestamps=true;
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
