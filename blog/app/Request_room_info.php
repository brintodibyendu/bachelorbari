<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request_room_info extends Model
{
    //
    protected $table='request_room_info';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=['rpname','cost','from_date','to_date','flat_name'];
        public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
