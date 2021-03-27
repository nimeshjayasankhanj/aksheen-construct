<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

    protected $table='stock';
    protected  $primaryKey='idstock';

    public function Product(){
        return $this->belongsTo(Product::class,'product_idproduct');
    }

}
