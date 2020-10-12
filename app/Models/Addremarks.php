<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addremarks extends Model
{
    protected $table = 'addremarks';
    protected $fillable = ['storecode','date','remarks'];
}
