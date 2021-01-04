<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_seller extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tj_products_of_seller';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = []; 
    protected $dates = ['created_at','updated_at'];

    /**
     * Get the variant for the blog post.
     */
    public function seller()
    {
        return $this->hasOne(User::class,'id','seller_id');
    }

}

