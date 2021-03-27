<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterConstruction extends Model
{

    protected $table='master_construction';
    protected  $primaryKey='idmaster_construction';

    public function User(){
        return $this->belongsTo(User::class,'customer');
    }
}
