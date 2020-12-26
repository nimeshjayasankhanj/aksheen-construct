<?php
/**
 * Created by PhpStorm.
 * User: nimeshjayasankha
 * Date: 10/6/20
 * Time: 10:03 PM
 */

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Employee
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->user_role_iduser_role==2 || Auth::user()->user_role_iduser_role==1){

            return true;
        }
        else{
            return redirect('/');
        }
    }

}