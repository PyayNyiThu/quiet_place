<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomService extends Model
{
    use SoftDeletes;

    protected $table = 'room_service';
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['room_id', 'service_id'];
}
