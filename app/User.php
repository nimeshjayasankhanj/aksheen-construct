<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $table='user';
    protected  $primaryKey='iduser';

    public function Supplier(){
        return $this->belongsTo(Supplier::class,'supplier_idsupplier');
    }

    public function MasterConstruction(){
        return $this->hasMany(MasterConstruction::class,'customer');
    }
    public function Employee(){
        return $this->hasMany(Employee::class,'user_iduser');
    }
}
