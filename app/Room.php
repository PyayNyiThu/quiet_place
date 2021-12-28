<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $table = 'rooms';
    protected $dates = ['deleted_at'];

    protected $fillable=['price', 'photo', 'description', 'roomtype_id', 'township_id', 'size', 'capacity'];

    public function roomtype() {
      return $this->belongsTo('App\Roomtype');
    }

    public function township() {
      return $this->belongsTo('App\Township');
    }

    public function services() {
      return $this->belongsToMany('App\Service')->withTimestamps();
    }

    public function bookings() {
      return $this->hasMany('App\Booking');
    }
}
