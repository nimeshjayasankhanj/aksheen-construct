<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterGrn extends Model
{

    protected $table='master_grn';
    protected  $primaryKey='idmaster_grn';

    public function Product(){
        return $this->hasMany(Product::class,'category_idcategory');
    }

    public function Supplier(){
        return $this->belongsTo(Supplier::class,'supplier_idsupplier');
    }
}
