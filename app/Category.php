<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table='category';
    protected  $primaryKey='idcategory';

    public function Product(){
        return $this->hasMany(Product::class,'category_idcategory');
    }

}
