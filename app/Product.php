<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table='product';
    protected  $primaryKey='idproduct';

    public function Category(){
        return $this->belongsTo(Category::class,'category_idcategory');
    }

    public function Product(){
        return $this->hasMany(Product::class,'product_idproduct');
    }

}
