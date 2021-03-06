<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use SoftDeletes;

    protected $table = 'room_types';
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['name'];

    public function rooms() {
        return $this->hasMany('App\Room', 'roomtype_id', 'id');
    }
}
