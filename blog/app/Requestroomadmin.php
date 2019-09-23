<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestroomadmin extends Model
{
    //
    protected $table='requestroomadmin';
    public $primaryKey='id';
    public $timestamps=true;
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
