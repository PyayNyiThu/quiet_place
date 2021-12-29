<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $table = 'bookings';
    protected $dates = ['deleted_at'];

    protected $fillable=['booking_no', 'customer_id', 'room_id', 'booking_date', 'time', 'status'];

    public function room() {
      return $this->belongsTo('App\Room');
    }

     public function roomtype() {
      return $this->belongsTo('App\Roomtype');
    }

    public function township() {
      return $this->belongsTo('App\Township');
    }

    public function customer() {
      return $this->belongsTo('App\Customer');
    }
}
