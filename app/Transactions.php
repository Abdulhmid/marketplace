<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tj_transactions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = []; 
    protected $dates = ['created_at','updated_at'];

    /**
     * Get the variant for the blog post.
     */
    public function detail()
    {
        return $this->hasMany(Transactions_detail::class,'transaction_code','transaction_code');
    }

    public function status()
    {
        return $this->hasMany(Transactions_status::class,'transaction_code','transaction_code');
    }

}

