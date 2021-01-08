<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tj_withdraw_income';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = []; 
    protected $dates = ['created_at','updated_at'];

}

