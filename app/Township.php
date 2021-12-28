<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Township extends Model
{
    use SoftDeletes;

    protected $table = 'townships';
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['name'];
}
