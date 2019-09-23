<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pending_request extends Model
{
    //
      protected $table='pending_request';
    public $primaryKey='id';
    public $timestamps=true;
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
