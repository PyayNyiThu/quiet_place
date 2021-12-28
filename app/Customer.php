<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $table = 'customers';
    protected $dates = ['deleted_at'];

    protected $fillable=['name', 'password', 'email', 'phone', 'address'];
}
