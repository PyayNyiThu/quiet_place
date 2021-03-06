<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = 'services';
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['name', 'photo'];

    public function rooms() {
        return $this->belongsToMany('App\Room');
      }
}
