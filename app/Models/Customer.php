<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasApiTokens, Notifiable;

    protected $table = 'customer';
    protected $fillable = ['name','address','phone'];


    // this is to hide the field is api.

}
