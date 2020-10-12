<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreList extends Model
{
    protected $table = 'store_list';
    protected $fillable = ['Scode','StoreName','Dorm','Area','StoreStatus'];

    public function remarks(){

        return $this->hasMany(Addremarks::class);

    }

}
