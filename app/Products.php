<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tj_products';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = []; 
    protected $dates = ['created_at','updated_at'];
    
    /**
     * Get the variant for the blog post.
     */
    public function variant()
    {
        return $this->hasMany(Product_variant::class,'product_id');
    }

    /**
     * Get the variant for the blog post.
     */
    public function category()
    {
        return $this->hasOne(Product_category::class,'id','product_category_id');
    }

    /**
     * Get the variant for the blog post.
     */
    public function seller()
    {
        return $this->hasMany(Product_seller::class,'product_id');
    }

    /**
     * Get the variant for the blog post.
     */
    public function produsen()
    {
        return $this->hasOne(Produsen::class,'id','produsen_id');
    }

    /**
     * Get the variant for the blog post.
     */
    public function stock()
    {
        return $this->hasMany(Product_variant::class,'product_id');
    }


}

