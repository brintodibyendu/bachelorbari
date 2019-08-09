<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room_info extends Model
{
    //
    protected $table='room_info';
    public $primaryKey='id';
    public $timestamps=true;
    protected $fillable=['rpname','cost','from_date','to_date','flat_name'];
        public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
