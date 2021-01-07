<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tj_users_ledger';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = []; 
    protected $dates = ['created_at','updated_at'];

}

